<?php

namespace App\Http\Traits;

use Auth;
use Google_Client;
use Google_Service_YouTube;
use GuzzleHttp\Client;
use Illuminate\Auth\Authenticatable;

/**
 * Class YoutubeTrait
 *
 * Class containing useful methods for using the Youtube API
 *
 * @package App\Http\Traits
 * @author ZeLarpMaster
 */
trait YoutubeTrait {
	/**
	 * Generate and return an url to log into Youtube
	 * The url automatically sets the refresh token and
	 * 		goes back to where the user was
	 *
	 * @return string  The URL for the Youtube connection
	 */
	public function generateYoutubeUrl() {
		$client = $this->getGoogleClient();
		return $client->createAuthUrl();
	}

	/**
	 * Check whether or not the currently logged in user has a connection token
	 *
	 * @return bool  True if the user has a refresh token
	 */
	public function isLoggedInYoutube() {
		return Auth::user()->refresh_token_youtube !== null;
	}

	/**
	 * Logout the Google Client
	 */
	public function logoutYoutube() {
		$client = $this->getAuthenticatedGoogleClient();
		$client->revokeToken();
	}

	/**
	 * Refresh the access token if it's expired on the given client
	 *
	 * @param Google_Client $client  The client on which the token is refreshed
	 */
	public function setAccessTokenYoutube(Google_Client $client) {
		$access_token = json_decode(Auth::user()->access_token_youtube, true);
		$client->setAccessToken($access_token);
		if($client->isAccessTokenExpired()) {
			$refresh_token = Auth::user()->refresh_token_youtube;
			$new_token = $client->fetchAccessTokenWithRefreshToken($refresh_token);
			$client->setAccessToken($new_token);
			Auth::user()->access_token_youtube = json_encode($new_token);
			Auth::user()->save();
		}
	}

	/**
	 * Configures and returns a Google Client
	 *
	 * @return Google_Client  The initialized Google_Client
	 */
	private function getGoogleClient(): Google_Client {
		$client = new Google_Client();
		$client->setHttpClient(new Client(array(
			'verify' => false,
		)));
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setApprovalPrompt("force"); // ask for a refresh_token
		$client->setAccessType("offline");        // offline access
		$client->setIncludeGrantedScopes(true);   // incremental auth
		$client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
		$client->setRedirectUri(route('youtubeCallback'));
		return $client;
	}

	/**
	 * Configures, authenticates, and returns a Google Client
	 *
	 * @return Google_Client  The authenticated Google_Client
	 */
	private function getAuthenticatedGoogleClient(): Google_Client {
		$client = $this->getGoogleClient();
		$this->setAccessTokenYoutube($client);
		return $client;
	}

	/**
	* Get the videos from your subs
	*/
	public function getSubVideos() {
		$this->getVideoActivities();
	}

	/**
	* Get an array of your sub id
	*/
	private function getSubId($youtube) {
        $subscriptions = [];
        $nextPage = null;
        do {
            $response = $youtube->subscriptions->listSubscriptions('snippet',
                ['mine' => true, 'maxResults' => 50, 'pageToken' => $nextPage]);
            foreach ($response->getItems() as $item) {
                $subscriptions[] = $item->snippet['resourceId']['channelId'];
            }
            $nextPage = $response['nextPageToken'];
        } while($response['nextPageToken']);
        return $subscriptions;
	}

    public function getVideoActivities() {
        $client = $this->getAuthenticatedGoogleClient();
        $youtube = new Google_Service_YouTube($client);
        $subscriptions = $this->getSubId($youtube);
        $videoIds = [];
        $videos = [];
        foreach ($subscriptions as $subscription) {
            $response = $youtube->activities->listActivities('contentDetails',
                ['channelId' => $subscription, 'maxResults' => 5]);
            foreach($response->getItems() as $item) {
                if (isset($item['upload'])) {
                    $videoIds[] = $item->contentDetails['upload']['videoId'];
                }
            }
        }
        foreach ($videoIds as $videoId) {
            $response = $youtube->videos->listVideos('snippet', ['id' => $videoId, 'maxResults' => 1]);
            foreach ($response->getItems() as $item) {
                $tempItem = $item['snippet'];
                $tempItem['videoId'] = $item->id;
                $videos[] = $tempItem;
            }
        }
        usort($videos, function($a, $b)
        {
            if ($a['publishedAt'] == $b['publishedAt']) {
                return 0;
            }
            return ($a['publishedAt'] > $b['publishedAt']) ? -1 : 1;
        });
        return $videos;
    }
}

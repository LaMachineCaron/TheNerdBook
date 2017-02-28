<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\YoutubeTrait;
use App\Http\Traits\TwitchTrait;
use Illuminate\Support\Facades\Redirect;

class ProfilController extends Controller
{
    use YoutubeTrait, TwitchTrait;

    public function index() {
        return view('user.profil');
    }

    public function disconnectYoutube() {
        $this->logoutYoutube();
    }

    public function disconnectTwitch() {
        $this->logoutTwitch();
    }

    public function update(Request $request) {
        $data = $request->all();
        $message = "";
        if (isset($data['youtubeDisconnect'])) {
            $this->disconnectYoutube();
            $message = "Vous êtes déconnecté de Youtube";
        }
        if (isset($data['twitchDisconnect'])) {
            $this->disconnectTwitch();
            $message = "Vous êtes déconnecté de Twitch";
        }

        return Redirect::back()->with('status', $message);
    }
}

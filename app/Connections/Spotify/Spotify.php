<?php

namespace App\Connections\Spotify;

/**
 *
 */
class Spotify
{
    /**
    * The access_token provided after authenticating with the Spotify API
    */
    public $sAccessToken;

    /**
    * Sets the access token. A valid access token is required to run queries against the Spotify API
    *
    * @param   string   $accessToken The user's access token, retrieved from the Spotify API
    *
    * @return   Spotify object
    */
    public function setAccessToken($sAccessToken): self
    {
        $this->sAccessToken = $sAccessToken;

        return $this;
    }
}

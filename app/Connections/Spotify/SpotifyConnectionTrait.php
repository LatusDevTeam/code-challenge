<?php

namespace App\Connections\Spotify;

/**
 * A trait to handle the Spotify connection
 */
trait SpotifyConnectionTrait
{
    /**
     * Will hold the Spotify object
     */
    public $oSpotify;

    /**
     * The URL to obtain the auth token
     */
    private $sTokenUrl = 'https://accounts.spotify.com/api/token';

    /**
     * The Client ID
     */
    private $sClientId = '6ecdc7ec14cc411bbfbe2caa60ff88d3';

    /**
     * The Client Secret
     */
    private $sClientSecret = '698120fbf1494e2dadf9e5f2574ec4fb';

    /**
     * Create the connection
     */
    public function createConnection(): void
    {
        $this->oSpotify = $this->getSpotify();
    }

    /**
     * Fetch the cached Spotify object, or create and return if none already exists.
     *
     * @return  Spotify
     */
    protected function getSpotify(): Spotify
    {
        if (!$this->oSpotify instanceof Spotify) {
            $this->oSpotify = new Spotify();
            $this->oSpotify->setAccessToken($this->requestAccessToken());
        }

        return $this->oSpotify;
    }

    /**
     * Request the access token
     *
     * @return   string   Access token
     */
    private function requestAccessToken(): string
    {
        try {
            /* Get Spotify Authorization Token */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,            $this->sTokenUrl );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_POST,           1 );
            curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' );
            curl_setopt($ch, CURLOPT_HTTPHEADER,     ['Authorization: Basic ' . base64_encode($this->sClientId . ':' . $this->sClientSecret)]);

            $aResult=curl_exec($ch);
            $aJson = json_decode($aResult, true);

            return $aJson['access_token'];

        } catch (\Exception $oException) {
            return back()->withError($oException->getMessage())->withInput();
        }

        return '';
    }
}

<?php

namespace App\Connections\Spotify;

/**
 * A class to handle the Spotify requests
 */
class SpotifyRequest
{
    use SpotifyConnectionTrait;

    public function __construct(array $aConfig = [])
    {
        $this->createConnection();
    }

    /**
     * Search using the user's query
     *
     * @param   string   $sQuery   The user's query string
     */
    public function search($sQuery): array
    {
        try {
            /* Query Spotify */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer ' . $this->oSpotify->sAccessToken ));
            curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?type=album&q=' . $sQuery);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $aResult=curl_exec($ch);
            $aJson = json_decode($aResult, true);

            return $aJson;

        } catch (\Exception $oException) {
            return back()->withError($oException->getMessage())->withInput();
        }
    }

    /**
     * Get tracks associated with an album
     *
     * @param  integer   $iAlbumId   The album ID
     */
    public function getTracks($iAlbumId): array
    {
        try {
            /* Query Spotify */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer ' . $this->oSpotify->sAccessToken ));
            curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/albums/' . $iAlbumId  . '/tracks');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $aResult=curl_exec($ch);
            $aJson = json_decode($aResult, true);

            return $aJson;

        } catch (\Exception $oException) {
            return back()->withError($oException->getMessage())->withInput();
        }
    }
}

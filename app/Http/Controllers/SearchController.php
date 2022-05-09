<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        $access_token =  $this->get_shopify_access_token();
        $response = array();
        if(!empty($access_token)){
            $response['track'] = $this->get_list($query,'track',$access_token);
            $response['album'] = $this->get_list($query,'album',$access_token);
            $response['artists'] = $this->get_list($query,'artist',$access_token);
        }
        echo "<pre>";
        print_r($response);
        exit;
        return view('search', ['searchTerm' => $query,'response'=>$response]);
    }

    public function get_list($query="",$type="",$access_token=""){
        $authorization = "Authorization: Bearer ".$access_token; // Prepare the authorisation token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q='.$query.'&type='.$type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $authorization,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    public function get_shopify_access_token(){
        $client_id = '8c115764ea694b44b6bb9caa471a5d19'; 
        $client_secret = '33bafb4ee0834c9ea4d9a61d8112ebdf'; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
        $result=curl_exec($ch);
        $result = json_decode($result);
        if(!empty($result->error)){
            return null;
        }
        
        return $result->access_token;
    }
}

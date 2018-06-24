<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class BaseModel extends Model {

    public static function getJson($url = '') {
        $client = new Client(['base_uri' => 'https://shiftstestapi.firebaseio.com/']);

        try {
            $res = $client->request('GET', $url, [
            ]);
            return json_decode($res->getBody());
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}

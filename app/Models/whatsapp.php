<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class whatsapp extends Model
{
    use HasFactory;

    public static function sendMessage($vetor, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v18.0/234377473099729/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($vetor),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        logger($response);
        curl_close($curl);
        return $response;
    }
}

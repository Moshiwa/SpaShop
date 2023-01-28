<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token = '5862692795:AAEwKiM2yA4IJLYdNswFGF7RKwVrtZMxmJM';

    public function getMe()
    {
        $client = new Client(['verify' => false]);
        $response = $client->get('https://api.telegram.org/bot'.$this->token.'/getMe');
        dd($response);
    }
}

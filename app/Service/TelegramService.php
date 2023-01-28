<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token;

    public function __construct()
    {
        $this->token = env('TELEGRAM_TOKEN');
    }
    public function sendMessage()
    {
        $client = new Client(['verify' => false]);
        $response = $client->get('https://api.telegram.org/bot'.$this->token.'/getMe');
        dd($response);
    }
}

<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token;
    private Client $client;
    private string $chat_id;

    public function __construct()
    {
        $this->token = env('TELEGRAM_TOKEN');
        $this->client = new Client(['verify' => false, 'Content-Type' => 'application/json']);
        $this->chat_id = env('TELEGRAM_CHAT_ID') ?? $this->defineChatId();
    }

    private function defineChatId(): string
    {
        $response = $this->client->get('https://api.telegram.org/bot'.$this->token.'/getUpdates');
        $data = $response->getBody()->getContents();
        $data = json_decode($data, true);

        return $data['result']['message']['chat']['id'] ?? '';
    }

    public function sendMessage($order)
    {
        $text = 'Адресат: ' . $order->customer . "\n";
        foreach ($order->products as $product) {
            $text .= 'Продукт №' . $product->id . '. ' . $product->name . ' - ' . $product->price . 'руб.' . "\n";
        }

        $params = [
            'chat_id' => $this->chat_id,
            'text' => $text
        ];

        $response = $this->client->post(
            'https://api.telegram.org/bot'.$this->token.'/sendMessage?' . http_build_query($params));

        return $response->getBody()->getContents();
    }
}

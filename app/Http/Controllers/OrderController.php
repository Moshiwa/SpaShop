<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Service\TelegramService;
use Illuminate\Support\Arr;



class OrderController extends Controller
{
    public function save(OrderRequest $request)
    {
        $save_params = $request->validated();
        $order = Order::query()->create([
            'customer' => $save_params['customer']
        ]);

        $order->products()->attach(Arr::flatten($save_params['data']));

        (new TelegramService())->sendMessage();
    }
}

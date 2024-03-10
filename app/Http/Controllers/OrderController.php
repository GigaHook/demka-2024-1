<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): \Inertia\Response
    {
        $user = auth()->user();
        $data = $user->admin ? Order::lazyByIdDesc() : $user->orders()->lazyByIdDesc();

        return inertia('Orders/Index', [
            'orders' => OrderResource::collection($data),
        ]);
    }

    public function create(): \Inertia\Response
    {
        return inertia('Orders/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        auth()->user()->orders()->create($request->all());
        return to_route('orders.index');
    }

    public function update(Order $order, Request $request): void
    {
        $order->update([
            'status' => $request->status,
        ]);
    }
}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white text-black rounded shadow">
    <h1 class="text-2xl font-bold mb-4">All Orders</h1>

    @if ($orders->isEmpty())
        <p class="text-gray-700 italic">No orders have been placed yet.</p>
    @else
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Order ID</th>
                    <th class="px-4 py-2">Customer</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Payment</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Items</th>
                    <th class="px-4 py-2">Placed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $order->id }}</td>
                        <td class="px-4 py-2">{{ $order->name }}</td>
                        <td class="px-4 py-2">{{ $order->email }}</td>
                        <td class="px-4 py-2">{{ ucfirst($order->payment_type) }}</td>
                        <td class="px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                        <td class="px-4 py-2">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($order->items as $item)
                                    <li>{{ $item['name'] }} x {{ $item['quantity'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

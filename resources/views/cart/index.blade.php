@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 bg-white text-black min-h-screen py-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (empty($cart))
        <div class="text-gray-700 italic">Your cart is empty.</div>
    @else
        <table class="w-full table-auto border-collapse mb-6">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    @endphp
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item['name'] }}</td>
                        <td class="px-4 py-2">${{ number_format($item['price'], 2) }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                       class="w-16 text-center border rounded px-2 py-1 mr-2">
                                <button type="submit" class="bg-blue-500 text-black px-2 py-1 rounded hover:bg-blue-600">Update</button>
                            </form>
                        </td>
                        <td class="px-4 py-2">${{ number_format($total, 2) }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="border-t font-bold">
                    <td colspan="3" class="px-4 py-2 text-right">Grand Total:</td>
                    <td class="px-4 py-2">${{ number_format($grandTotal, 2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('checkout.form') }}" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded">
            Proceed to Checkout
        </a>
    @endif
</div>
@endsection

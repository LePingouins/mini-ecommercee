@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 bg-white text-black rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.submit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Full Name:</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name') }}">
        </div>

        <div>
            <label class="block font-semibold">Email:</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email') }}">
        </div>

        <div>
            <label class="block font-semibold">Shipping Address:</label>
            <textarea name="address" rows="3" class="w-full border px-3 py-2 rounded">{{ old('address') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Payment Type:</label>
            <select name="payment_type" class="w-full border px-3 py-2 rounded">
                <option value="">Select</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash">Cash on Delivery</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded">
            Place Order
        </button>
    </form>
</div>
@endsection

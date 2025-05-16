@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('products.create') }}"
            class="bg-gray-100 hover:bg-gray-200 text-black font-semibold px-4 py-2 rounded border border-gray-400 shadow">
            Add New Product
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">{{ $product->category }}</td>
                    <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-2">{{ $product->stock_quantity }}</td>
                    <td class="px-4 py-2 space-y-1">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:underline block font-medium">Edit</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline block font-medium"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline block font-medium">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-700 italic bg-gray-50">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

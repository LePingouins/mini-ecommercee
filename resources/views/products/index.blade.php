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
            class="bg-white text-black font-semibold px-4 py-2 rounded border border-gray-300 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:bg-gray-100 transition transform duration-200 ease-in-out">
            Add New Product
        </a>
    </div>

    <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-md">
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
                    <tr class="hover:bg-gray-50 transition border-b border-gray-300">
                        <td class="px-4 py-4">{{ $product->name }}</td>
                        <td class="px-4 py-4">{{ $product->category }}</td>
                        <td class="px-4 py-4">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-4">{{ $product->stock_quantity }}</td>
                        <td class="px-4 py-4">
                            <div class="space-y-2">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 shadow transition block text-center">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-100 text-red-800 px-3 py-1 rounded hover:bg-red-200 shadow transition w-full"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-green-100 text-green-800 px-3 py-1 rounded hover:bg-green-200 shadow transition w-full">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
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
</div>
@endsection

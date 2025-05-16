@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Name:</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label class="block">Category:</label>
            <input type="text" name="category" class="w-full border rounded px-3 py-2" value="{{ old('category', $product->category) }}">
        </div>

        <div>
            <label class="block">Description:</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block">Price:</label>
            <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" value="{{ old('price', $product->price) }}">
        </div>

        <div>
            <label class="block">Stock Quantity:</label>
            <input type="number" name="stock_quantity" class="w-full border rounded px-3 py-2" value="{{ old('stock_quantity', $product->stock_quantity) }}">
        </div>

        <div>
            <label class="block">Current Image:</label>
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" class="h-32 mb-2" alt="Product image">
            @else
                <p class="text-gray-500">No image uploaded.</p>
            @endif
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Product</button>
    </form>
</div>
@endsection

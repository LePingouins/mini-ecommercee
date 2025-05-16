@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block">Name:</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
        </div>

        <div>
            <label class="block">Category:</label>
            <input type="text" name="category" class="w-full border rounded px-3 py-2" value="{{ old('category') }}">
        </div>

        <div>
            <label class="block">Description:</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block">Price:</label>
            <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" value="{{ old('price') }}">
        </div>

        <div>
            <label class="block">Stock Quantity:</label>
            <input type="number" name="stock_quantity" class="w-full border rounded px-3 py-2" value="{{ old('stock_quantity') }}">
        </div>

        <div>
            <label class="block">Image:</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded">Save Product</button>
    </form>
</div>
@endsection

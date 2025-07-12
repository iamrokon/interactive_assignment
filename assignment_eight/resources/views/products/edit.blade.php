@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 h-11 px-4 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 px-4 py-2.5 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input
                    type="number"
                    name="price"
                    id="price"
                    value="{{ old('price', $product->price) }}"
                    step="0.01"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 h-11 px-4 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    value="{{ old('quantity', $product->quantity) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 h-11 px-4 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="mt-1 block w-full rounded-md border-gray-300 h-11 px-4 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection

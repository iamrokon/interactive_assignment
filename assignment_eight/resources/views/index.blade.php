@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Products</h1>
        <div class="mb-6">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name, description, or category"
                    class="w-full sm:w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach ($products as $product)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        <p class="text-indigo-600 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                        class="px-4 py-2 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Update
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <p class="text-gray-500">No products found.</p>
        @endif
    </div>
@endsection

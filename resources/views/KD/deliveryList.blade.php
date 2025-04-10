@extends('layout.deliverHeader')

@section('content')
@include('sweetalert::alert')
    <div class="container px-6 mx-auto">
        <h3 class="text-2xl font-medium text-gray-700">Delivery List</h3>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($orderedProducts as $product)
            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <img src="{{ ($product->image) }}" alt="Product Image" class="w-full max-h-60">
                <div class="flex items-end justify-end w-full bg-cover">

                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">Name: {{ $product->name }}</h3>

                    <span class="mt-2 text-gray-500"> price: {{ $product->price }} birr</span><br>
                    <span class="mt-2 text-gray-500"> Description: {{ $product->description }} </span>
                    <span class="mt-2 text-gray-500"> Ordered Quantity: {{ $product->ordered_quantity }} </span>

                    <form action="{{ ('/deliveryCartCreate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->description }}" name="description">
                        <input type="hidden" value="{{ $product->image }}"  name="image">
                        <input type="hidden" value="{{ $product->ordered_quantity }}"  name="ordered_quantity">
                        <input type="hidden" value="{{ $product->order_id }}"  name="order_id">
                       <label class="mt-2 text-gray-500">delivery quantity</label>
                       <input  type="number" value="" name="quantity" placeholder="add quantity here " required><br><br>
                        <button class="px-4 py-2 text-white bg-blue-800 rounded">add to delivery cart</button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
    </div>
@endsection

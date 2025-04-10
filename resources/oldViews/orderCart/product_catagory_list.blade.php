@extends('layout.cartHeader')
@section('content')
@include('sweetalert::alert'
<div class="container px-6 mx-auto">
    <h3 class="text-2xl font-medium text-gray-700">Catagorie</h3>
      <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
         @foreach ($productsCatagories as $productsCatagories) 
        <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <img src="{{ ($productsCatagories->image) }}" alt="Catagory Image" class="w-full max-h-60">
                <div class="flex items-end justify-end w-full bg-cover">                  
                </div>
               <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">Name: {{ $productsCatagories->name }}</h3>
                    <span class="mt-2 text-gray-500"> Description: {{ $productsCatagories->description }}</span>
                    <form action="{{ ('/productList') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $productcatagory->id }}" name="prouductCatagory_id">
                        <button class="px-4 py-2 text-white bg-blue-800 rounded">View</button>

                    </form>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

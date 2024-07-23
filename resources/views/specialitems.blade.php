@extends('layouts.main')

@section('content')
<div class="tm-list">
    @foreach($specialItems as $product)
    <div class="tm-list-item">          
        <img src="{{ asset($product->image) }}" alt="Image" class="tm-list-item-img">
        <div class="tm-black-bg tm-list-item-text">
            <h3 class="tm-list-item-name"><span class="tm-list-item-price">{{ $product->title}}</span></h3>
            <p class="tm-list-item-description">{{ $product->content }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection

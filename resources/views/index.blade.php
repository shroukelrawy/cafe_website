@extends('layouts.main')

@section('content')

<nav class="tm-black-bg tm-drinks-nav">
    <ul>
        @foreach($categories as $category)
        <li>
            <a href="" class="tm-tab-link {{ $loop->first ? 'active' : '' }}" data-id="{{ $category->id }}">{{ $category->name }}</a>
        </li>
        @endforeach
    </ul>
</nav>

@foreach($categories as $category)
<div id="{{ $category->id }}" class="tm-tab-content" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">
    <div class="tm-list">
        @foreach($category->beverages as $beverage)
        <div class="tm-list-item">          
            <img src="{{ asset($beverage->image) }}" alt="{{ $beverage->title }}" class="tm-list-item-img">
            <div class="tm-black-bg tm-list-item-text">
                <h3 class="tm-list-item-name">{{ $beverage->title }}<span class="tm-list-item-price">${{ $beverage->price }}</span></h3>
                <p class="tm-list-item-description">{{ $beverage->content }}</p>
            </div>
        </div>
        
        @endforeach
    </div>
</div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.tm-tab-link');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            const id = this.getAttribute('data-id');
            document.querySelectorAll('.tm-tab-content').forEach(content => {
                content.style.display = content.getAttribute('id') == id ? 'block' : 'none';
            });
            links.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Open the first category by default
    if (links.length > 0) {
        links[0].click();
    }
});
</script>

@endsection

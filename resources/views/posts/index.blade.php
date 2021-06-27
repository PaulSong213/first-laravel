@extends('layouts.app')
@section('title', 'Posts')

@section('content')
    
<main>
    <section>
        <table-data :datas='{{ $posts->getCollection()->toJson() }}' :attributes=' {{ json_encode($attributes) }} ' ></table-data>
        {{-- <x-table :datas="$posts" title="Posts Table"></x-table> --}}
    </section>
    <section class="my-4 px-2 overflow-hidden z-20">
        {{ $posts->links() }}
    </section>
</main>
@endsection
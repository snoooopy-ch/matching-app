@extends('front.layouts.main')

@section('title', $title)

@section('content')
    <blog :category="'{{ $category }}'" :blog-id="{{ $blog_id }}"></blog>
@endsection
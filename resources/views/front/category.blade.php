@extends('front.layouts.main')

@section('title', $title)

@section('content')
    <blog-category :category-slug="'{{ $category_slug }}'"></blog-category>
@endsection

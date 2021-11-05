@extends('front.layouts.main')

@section('title', $title)

@section('content')
    <ranking 
        :scene-id="'{{ $scene_id }}'"
        :scene-name="'{{ $scene_name }}'"
        :category-id="'{{ $category_id }}'"
        :category-name="'{{ $category_name }}'"
    >
    </ranking>
@endsection
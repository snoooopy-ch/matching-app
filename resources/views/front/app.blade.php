@extends('front.layouts.main')

@section('title', $title)

@section('content')
    <app-detail :app-id="{{ $app_id }}"></app-detail>
@endsection
@php
    $title = 'Page not found';
@endphp

@extends('layouts.public')

@section('content')
    <section class="container-site py-20">
        <x-empty-state title="This page could not be found" action-label="Back to home" action-url="{{ route('home') }}">
            The address may have changed, or the page is not published yet.
        </x-empty-state>
    </section>
@endsection

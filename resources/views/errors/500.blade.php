@php
    $title = 'Something went wrong';
@endphp

@extends('layouts.public')

@section('content')
    <section class="container-site py-20">
        <x-empty-state title="Something went wrong" action-label="Back to home" action-url="{{ url('/') }}">
            Please try again in a moment. If the problem continues, contact the organization using the published phone or email.
        </x-empty-state>
    </section>
@endsection

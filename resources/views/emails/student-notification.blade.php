@extends('layouts.email')

@section('subject', $subject)

@isset($link)
    @section('link')
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ $link }}" target="_blank" class="btn">
                {{ __('Click here') }}
            </a>
        </div>
    @endsection
@endisset

@section('content')
    <div class="content">
        <h2 style="color: #0d6efd; text-align: center; font-size: 24px; font-weight: bold; padding-top: 15px;">
            {{ $subject }}
        </h2>
        <p style="font-size: 16px; color: #555; line-height: 1.8; text-align: center;">
            {{ $message }}
        </p>
    </div>
@endsection

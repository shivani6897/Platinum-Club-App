@extends('layouts.app')
@section('heading', 'Subscription')

@section('content')
    <div class="container">
        <div>
            <a href="{{route('add-subscription.index')}}"
                class="btn px-2 py-1 space-x-2 border border-primary font-medium text-primary float-right">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Add subscription</span>
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>

    </style>
@endpush

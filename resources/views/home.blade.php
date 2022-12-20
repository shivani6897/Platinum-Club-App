@extends('layouts.app')

@section('heading', 'Dashboard')
@section('content')
<div class="my-3 flex h-8 items-center justify-between">
    <h2
        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
    >
    <label class="flex items-center space-x-2">
        {{ __('You are logged in!') }}
  </label>
</div>
@endsection

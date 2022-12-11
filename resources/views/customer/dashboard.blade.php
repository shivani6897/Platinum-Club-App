@extends('layouts.app')

@section('heading', 'Dashboard')

@section('breadcrums')
<div class="hidden h-full py-1 sm:flex">
  <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
</div>
<ul class="hidden flex-wrap items-center space-x-2 sm:flex">
  <li>Dashboard</li>
</ul>
@endsection

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

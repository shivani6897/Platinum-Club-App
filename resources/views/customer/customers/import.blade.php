@extends('layouts.app')

@section('heading', 'Customer')
@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{route('home')}}"
            >Dashboard</a
            >
            <svg
                x-ignore
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{route('customers.index')}}"
            >Customer</a
            >
            <svg
                x-ignore
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </li>
        <li>Customer</li>
    </ul>
@endsection
@section('content')
    {{ Form::open(['route' => ['customers.import'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12">
            <div class="card p-4 sm:p-5">
                <div class="mt-4 space-y-4">
                    <div class="row">
                        <div class="col-md-12 mb-6">
                            <span for="file" class="form-label">Download sample Customer CSV file</span>
                            <a href="{{ asset( '/customers_sample.csv') }}"
                               class="btn ml-2 space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <i class="ti ti-download"></i> {{ __('Download') }}
                            </a>
                        </div>
                        <div class="choose-files mt-3">
                            <span>Select CSV File</span>
                            <span class="relative mt-1.5 flex">
                                 <input type="file"
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        name="file" id="file"
                                        data-filename="file">
                             </span>
                        </div>


                        <div class="flex justify-end space-x-2 mt-5">
                            <a type="button"
                               href="{{route('customers.index')}}"
                               class="btn space-x-2 bg-bg-gradient-to-br bg-gradient-to-br from-info to-info-focus  font-medium text-white active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Cancel</a>
                            <input type="submit" value="{{ __('Upload') }}"
                                   class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection



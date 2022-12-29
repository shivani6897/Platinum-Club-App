@extends('layouts.app')

@section('heading', 'Profile')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="#"
            >
                Authorized Contact Person
            </a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12 grid lg:col-span-4 lg:place-items-center">
            <div>
                <ol
                    class="steps is-vertical line-space [--size:2.75rem] [--line:.5rem]"
                >
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100"
                        >
                            <i class="fa-solid fa-layer-group text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 1
                            </p>
                            <h3
                                class="text-base font-medium"
                            >
                                General Profile Details
                            </h3>
                        </div>
                    </li>
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100"
                        >
                            <i class="fa-solid fa-list text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 2
                            </p>
                            <h3 class="text-base font-medium">Business Physical Address</h3>
                        </div>
                    </li>
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-primary text-white dark:bg-accent"
                        >
                            <i class="fa-solid fa-truck-fast text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 3
                            </p>
                            <h3 class="text-base font-medium text-primary dark:text-accent-light">Authorized Contact Person</h3>
                        </div>
                    </li>
                </ol>
            </div>
        </div>

        <div class="col-span-12 grid lg:col-span-8">
            <div class="card">
                <div
                    class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5"
                >
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light"
                        >
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h4
                            class="text-lg font-medium text-slate-700 dark:text-navy-100"
                        >
                            Authorized Contact Person
                        </h4>
                    </div>
                </div>
                <form method="Post" action="{{ route('user.authorizeContact.post') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$userdetails ? $userdetails->id : ''}}">

                    <div class="space-y-4 p-4 sm:p-5">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <label class="block">
                            <span>Name</span>

                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Name"
                                type="text"
                                name="auth_name"
                                value="{{ old('auth_name',$userdetails->auth_name ?? '') }}"
{{--                                required--}}
                            />
                        </label>
                        <label class="block">
                            <span>Job Position</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                @error('job_position_id')
                                    border-error
                                @enderror"
                                name="job_position_id"
                                required
                            >
                                @foreach($jobpositions as $jobposition)
                                    <option value="{{$jobposition->id}}" @selected(old('job_position_id',0)==$jobposition->id)>{{$jobposition->name}}</option>
                                @endforeach
                            </select>
                            @error('job_position_id')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>Email</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Email Address"
                                type="email"
                                name="auth_email"
                                value="{{ old('name',$userdetails->auth_email ?? '') }}"
{{--                                required--}}
                            />
                        </label>

                        <label class="block">
                            <span>Phone No.</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Phone Number"
                                type="number"
                                name="auth_phone_no"
                                value="{{ old('auth_phone_no',$userdetails->auth_phone_no ?? '') }}"
                            />
                        </label>
                    </div>

                    <div class="flex justify-center space-x-2 pt-4">
                        <a
                            href="{{route('user.businessProfile')}}"
                            class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span>Prev</span>
                        </a>
                        <button
                            type="submit"
                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                            <span>Next</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
@endpush

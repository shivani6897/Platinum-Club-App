@extends('layouts.app')

@section('heading', 'Create Promocode')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{ route('admin.dashboard') }}"
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
                href="{{ route('promocodes.index') }}"
            >Promocode</a
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
        <li>Create</li>
    </ul>
@endsection
@section('content')
    <form method="POST"
          action="{{ route('promocodes.store') }}"
          accept-charset="UTF-8"
          class="p-lg-5 p-3"
          enctype="multipart/form-data"
          >
        @csrf

        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12">
                <div class="card p-4 sm:p-5">
                    <div class="mt-4 space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Code</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Code"
                                    type="text"
                                    name="code"
                                    autocomplete="off"
                                    value="{{ old('code') }}"
                                    required
                                />
                            </span>
                                @error('code')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>

                            {{--                            <label class="block">--}}
{{--                                <span>Start Date</span> <span>*</span>--}}
{{--                                <span class="relative flex">--}}
{{--                                <input--}}
{{--                                    data-enable-time=true--}}
{{--                                    x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"--}}
{{--                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent--}}
{{--                                    @error('start_date')--}}
{{--                                        border-error--}}
{{--                                    @enderror"--}}
{{--                                    placeholder="Choose date..."--}}
{{--                                    type="text"--}}
{{--                                    name="start_date"--}}
{{--                                    value="{{ old('start_date') }}"--}}
{{--                                    required--}}
{{--                                />--}}
{{--                                <span--}}
{{--                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"--}}
{{--                                >--}}
{{--                                    <svg--}}
{{--                                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        class="h-5 w-5 transition-colors duration-200"--}}
{{--                                        fill="none"--}}
{{--                                        viewBox="0 0 24 24"--}}
{{--                                        stroke="currentColor"--}}
{{--                                        stroke-width="1.5"--}}
{{--                                    >--}}
{{--                                      <path--}}
{{--                                          stroke-linecap="round"--}}
{{--                                          stroke-linejoin="round"--}}
{{--                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"--}}
{{--                                      />--}}
{{--                                    </svg>--}}
{{--                                  </span>--}}
{{--                                </span>--}}
{{--                                @error('start_date')--}}
{{--                                <span class="text-tiny+ text-error">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                            </label>--}}
                            <label class="block">
                                <span>Choose Date</span> <span>*</span>
                                <span class="relative flex">
                                <input
                                    data-mode= "range"
{{--                                    data-minDate= "today"--}}
{{--                                    data-enable-time=true--}}
                                    x-init="$el._x_flatpickr = flatpickr($el,{ minDate: 'today',altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                    @error('date')
                                        border-error
                                    @enderror"
                                    placeholder="Choose date..."
                                    type="text"
                                    name="date"
                                    value="{{ old('date') }}"
                                    required
                                />
{{--                                    <input type="hidden" name="start_date">--}}
{{--                                    <input type="hidden" name="end_date">--}}
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 transition-colors duration-200"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                    >
                                      <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                      />
                                    </svg>
                                  </span>
                                </span>
                                @error('date')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                            <label class="block col-span-2">
                                <span>Price Value</span> <span>*</span>
                                <span class="relative mt-1.5 flex mr-10">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Promocode Value"
                                    type="number"
                                    name="value"
                                    min="0"
                                    step="0.01"
                                    autocomplete="off"
                                    value="{{ old('value') }}"
                                    required
                                />
                            </span>
                                @error('value')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class=" inline-flex items-center space-x-2" x-data="{is_flat: ['is_flat']}" style="margin-top: 28px">
                                <input
                                    x-model="is_flat"
                                    type="checkbox"
                                    class="form-checkbox is-outline h-5 w-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    name="is_flat"
                                    id="is_flat"
                                    value="is_flat"
                                >
                                <p class="" for="is_flat">is flat?</p>
                            </label>
                            <label class=" inline-flex items-center space-x-2" x-data="{active: ['active']}" style="margin-top: 28px">
                                <input
                                    x-model="active"
                                    type="checkbox"
                                    class="form-checkbox is-outline h-5 w-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    name="active"
                                    id="active"
                                    value="active"
                                >
                                <p class="" for="active">is active?</p>
                            </label>

{{--                            <label class="block">--}}
{{--                                <span>is_flat</span>--}}
{{--                                <span class="relative mt-1.5 flex">--}}
{{--                                <input--}}
{{--                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"--}}
{{--                                    placeholder="is_flat"--}}
{{--                                    type="text"--}}
{{--                                    name="name"--}}
{{--                                    autocomplete="off"--}}
{{--                                    value="{{ old('is_flat') }}"--}}
{{--                                    required--}}
{{--                                />--}}
{{--                            </span>--}}
{{--                                @error('is_flat')--}}
{{--                                <span class="text-tiny+ text-error">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                            </label>--}}
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button
                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                            >
                                <span>Submit</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

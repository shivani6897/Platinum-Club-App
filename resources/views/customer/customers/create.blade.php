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
        <li>Add Customer</li>
    </ul>
@endsection

@section('content')
    <form method="POST"
          action="{{ route('customers.store') }}"
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
                                <span>Customer name</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Customer Name"
                                    type="text"
                                    name="name"
                                    autocomplete="off"
                                    value="{{ old('name') }}"
                                    required
                                />
                            </span>
                                @error('name')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class="block">
                                <span>Email</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Customer's Email"
                                    type="email"
                                    name="email"
                                    autocomplete="off"
                                    value="{{ old('email') }}"
                                    required
                                />
                            </span>
                                @error('email')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Phone Number</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                                <input
                                    x-input-mask="{
                                          numeric:true,
                                          blocks: [3, 3, 4],
                                      }"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Customer's Phone Number"
                                    type="text"
                                    name="phone_no"
                                    autocomplete="off"
                                    value="{{ old('phone_no') }}"
                                    required
                                />
                            </span>
                                @error('phone_no')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class="block">
                                <span>State</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="State"
                                    type="text"
                                    name="state"
                                    autocomplete="off"
                                    value="{{ old('state') }}"
                                    required
                                />
                            </span>
                                @error('state')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Company name</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Company Name"
                                        type="text"
                                        name="company_name"
                                        autocomplete="off"
                                        value="{{ old('company_name') }}"
                                    />
                                </span>
                                @error('company_name')
                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class="block">
                                    <span>Gst Number</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Gst Number"
                                            type="text"
                                            name="gst_no"
                                            autocomplete="off"
                                            value="{{ old('gst_no') }}"
                                            
                                        />
                                    </span>
                                    @error('gst_no')
                                        <span class="text-tiny+ text-error">{{$message}}</span>
                                    @enderror
                            </label>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                            <label class="block">
                                <span>Company's Address</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Company's Address"
                                        type="text"
                                        name="company_address"
                                        autocomplete="off"
                                        value="{{ old('company_address') }}"
                                        
                                    />
                                </span>
                                @error('company_address')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
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

@push('scripts')

@endpush

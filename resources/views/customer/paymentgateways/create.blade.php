@extends('layouts.app')

@section('heading', 'Update Payment Gateway')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{ route('home') }}"
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
                href="{{ route('paymentgateways') }}"
            >Payment Gateway</a
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
        <li>Update</li>
    </ul>
@endsection
@section('content')
    <form id="logout-form" action="{{ route('customer.store') }}" method="POST" class="d-none">
        @csrf
        <div class="grid grid-cols- gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12">
                <div class="card p-4 sm:p-5">
                    <div class="mt-4 space-y-4">

                        <input type="hidden" name="id" value="{{$paymentGateway->id}}">
                        @if($type==2)
                            <label>RazorPay Key </label>
                            <input type="text" name="razorpay_key"
                                   class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="RazorPay Key"
                                   value="{{$paymentGateway->razorpay_key}}">
                    </div>
                    <div class="mt-4 space-y-4">
                        <label>RazorPay Secret</label>
                        <input type="text" name="razorpay_secret"
                               class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                               placeholder="RazorPay Secret"
                               value="{{$paymentGateway->razorpay_secret}}">
                    </div>
                    @endif
                    @if($type==3)
                        <label>Instamojo Client ID </label>
                        <input type="text" name="instamojo_key"
                               class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                               placeholder="Instamojo Key"
                               value="{{$paymentGateway->instamojo_key}}">
                </div>
                <div class="mt-4 space-y-4">
                    <label>Instamojo Client Secret</label>
                    <input type="text" name="instamojo_token"
                           class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                           placeholder="Instamojo Token"
                           value="{{$paymentGateway->instamojo_token}}">
                </div>
                @endif
                @if($type==1)
                    <div class="mt-4 space-y-4">
                        <label> Stripe Key </label> <input
                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Stripe Key"
                            name="stripe_public"
                            type="text"
                            value="{{$paymentGateway->stripe_public}}"
                        />
                    </div>
                    <div class="mt-4 space-y-4">
                        <label>Stripe Secret </label> <input
                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Stripe Secret"
                            name="stripe_secret"
                            type="text"
                            value="{{$paymentGateway->stripe_secret}}"
                        />
                    </div>
                @endif
                <div class="flex flex-col pt-2 pb-5">
                    <div class="mt-3 px-4">
                        <button type="submit"
                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </form>
@endsection
@push('styles')
    <style type="text/css">
        .ql-toolbar.ql-snow + .ql-container.ql-snow {
            margin-top: 0px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#productForm").on("submit", function (e) {
                var hvalue = $('.ql-editor').html();
                $(this).append("<textarea name='description' style='display:none'>" + hvalue + "</textarea>");
            });
        });
    </script>
@endpush

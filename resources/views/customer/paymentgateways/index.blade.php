@extends('layouts.app')

@section('heading', 'Payment Gateways')

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

        </li>
        <li>Payment Gateways</li>
    </ul>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <!-- Club Table -->
        <div>
            <div class="flex items-center justify-between">
                <h2
                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                >
                    Payment Gateways Table
                </h2>
            </div>
            <div class="card mt-3">
                <div
                    class="is-scrollbar-hidden min-w-full overflow-x-auto"

                >
                    <table class="is-hoverable w-full text-left">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                #
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Logo
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Gateway Name
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Status
                            </th>
                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">1</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><img class="tbl-img"
                                                                                 src="{{ asset('/images/stripe.png') }}">
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"> Stripe</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if($paymentgateway->stripe_active==1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-error">InActive</span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div
                                    x-data="usePopper({placement:'bottom-end',offset:4})"
                                    @click.outside="if(isShowPopper) isShowPopper = false"
                                    class="inline-flex"
                                >
                                    <button
                                        x-ref="popperRef"
                                        @click="isShowPopper = !isShowPopper"
                                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                            />
                                        </svg>
                                    </button>
                                    <div
                                        x-ref="popperRoot"
                                        class="popper-root"
                                        :class="isShowPopper && 'show'"
                                    >
                                        <div
                                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                            <ul>
                                                <li>
                                                    @if($paymentgateway->stripe_secret != null)
                                                        @if($paymentgateway->stripe_active)
                                                            <a
                                                                href="{{url('/customer/payment-gateways/changeVisibility/'.$paymentgateway->id.'/0/stripe_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                InActive
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{url('/customer/payment-gateways/changeVisibility/'.$paymentgateway->id.'/1/stripe_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                Active
                                                            </a>
                                                        @endif
                                                    @endif
                                                </li>
                                                <li>
                                                    <a
                                                        href="/customer/payment-gateways/show/{{$paymentgateway->id}}/1"
                                                        type="button"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                    >Configure</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">2</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><img class="tbl-img2"
                                                                                 src="{{ asset('/images/Razorpay_logo.svg') }}">
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"> RazorPay</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if($paymentgateway->razorpay_active==1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-error">InActive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div
                                    x-data="usePopper({placement:'bottom-end',offset:4})"
                                    @click.outside="if(isShowPopper) isShowPopper = false"
                                    class="inline-flex"
                                >
                                    <button
                                        x-ref="popperRef"
                                        @click="isShowPopper = !isShowPopper"
                                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                            />
                                        </svg>
                                    </button>
                                    <div
                                        x-ref="popperRoot"
                                        class="popper-root"
                                        :class="isShowPopper && 'show'"
                                    >
                                        <div
                                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                            <ul>
                                                <li>
                                                    @if($paymentgateway->razorpay_key != null)
                                                        @if($paymentgateway->razorpay_active)
                                                            <a
                                                                href="{{url('/customer/payment-gateways/changeVisibility/'.$paymentgateway->id.'/0/razorpay_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                InActive
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{url('/customer/payment-gateways/changeVisibility/'.$paymentgateway->id.'/1/razorpay_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                Active
                                                            </a>
                                                        @endif
                                                    @endif
                                                </li>
                                                <li>
                                                    <a
                                                        href="/customer/payment-gateways/show/{{$paymentgateway->id}}/2"
                                                        type="button"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                    >Configure</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">2</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <img class="tbl-img2"
                                     src="{{ asset('/images/payment/instamojo.png')}}">
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"> Instamojo</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if($paymentgateway->instamojo_active==1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-error">InActive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div
                                    x-data="usePopper({placement:'bottom-end',offset:4})"
                                    @click.outside="if(isShowPopper) isShowPopper = false"
                                    class="inline-flex"
                                >
                                    <button
                                        x-ref="popperRef"
                                        @click="isShowPopper = !isShowPopper"
                                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                            />
                                        </svg>
                                    </button>
                                    <div
                                        x-ref="popperRoot"
                                        class="popper-root"
                                        :class="isShowPopper && 'show'"
                                    >
                                        <div
                                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                            <ul>
                                                <li>
                                                    @if($paymentgateway->instamojo_key != null)
                                                        @if($paymentgateway->instamojo_active)
                                                            <a
                                                                href="{{url
                                                                ('/customer/payment-gateways/changeVisibility/'
                                                                .$paymentgateway->id.'/0/instamojo_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                InActive
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{url('/customer/payment-gateways/changeVisibility/'.$paymentgateway->id.'/1/instamojo_active')}}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                Active
                                                            </a>
                                                        @endif
                                                    @endif
                                                </li>
                                                <li>
                                                    <a
                                                        href="/customer/payment-gateways/show/{{$paymentgateway->id}}/3"
                                                        type="button"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                    >Configure</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                >

                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style type="text/css">
        .tbl-img {
            height: 50px;
            width: 150px;
            object-fit: cover;
        }

        .tbl-img2 {
            height: 50px;
            width: 250px;
            object-fit: cover;
        }
    </style>
@endpush

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush


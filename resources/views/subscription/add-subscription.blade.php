@extends('layouts.app')
@section('heading', 'Add Subscription')

@section('content')
    <div class="bg-white rounded-md p-4 shadow-md container mx-auto">
        <div class="border-b border-sky-200 pb-3">
            <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Add Subscription
            </h3>
            <div class="justify-between items-center flex">
                <p>
                    You can manually add any subscription after assigning the specific product plan. If the customer
                    purchases any plan from the checkout page or via API, the subscription is created automatically.
                </p>
                <div>
                    <div x-data="{showModal:false}">
                        <button
                            @click="showModal = true"
                            class="btn px-2 py-1 space-x-2 border border-primary font-medium text-primary ">
                            <i class="fa-solid fa-video fa-2x"></i>
                        </button>
                        <template x-teleport="#x-teleport-target">
                            <div
                                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                x-show="showModal"
                                role="dialog"
                                @keydown.window.escape="showModal = false"
                            >
                                <div
                                    class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                    @click="showModal = false"
                                    x-show="showModal"
                                    x-transition:enter="ease-out"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                ></div>
                                <div
                                    class="relative max-w-md rounded-lg bg-white p-0 transition-all duration-300 dark:bg-navy-700 "
                                    x-show="showModal"
                                    x-transition:enter="easy-out"
                                    x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                    x-transition:leave="easy-in"
                                    x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                    x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                >
                                    <div
                                        class="relative  overflow-hidden w-96"
                                        style="padding-bottom: 56.25%"
                                    >
                                        <iframe
                                            src="https://www.youtube.com/embed/UBOj6rqRUME"
                                            frameborder="0"
                                            allowfullscreen
                                            class="absolute top-0 left-0 w-full h-full"
                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block">
                    <span>Customer Email <sup class="text-rose-500">*</sup></span>
                    <select
                        class="mt-1.5 w-full"
                        x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})"
                    >
                        <option></option>
                    </select>
                </label>
            </div>
            <div>
                <div class="pb-3"><label>Email To</label></div>
                <label class="inline-flex items-center space-x-2">
                    <input
                        class="form-checkbox is-basic h-5 w-5 rounded bg-slate-100 border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:bg-navy-900 dark:border-navy-500 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                        type="checkbox"/>
                    <p>example@gmail.com</p>
                </label> <br>
                <small>
                    Check if you want to notify this customer about his subscription via email.
                </small>
            </div>
        </div>
        {{--   TODO Assign Product and Plan     --}}
        <div class="card m-4 p-4">
            <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Assign Product and Plan
            </h3>
            <div class="grid grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="block">
                        <span>Select Product <sup class="text-rose-500">*</sup></span>
                        <select
                            class="form-select mt-1 h-8 w-full m  rounded-lg border border-slate-300 bg-white px-2.5 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                            <option>Test</option>
                        </select>
                    </label>
                    <small>
                        Select the product for which you want to create a subscription for your customer.
                    </small>
                </div>
            </div>
            <div class="mt-4">
                <div class="is-scrollbar-hidden min-w-full">
                    <table class="w-full text-left">
                        <thead>
                        <tr>
                            <th style="max-width:450px"
                                class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                PLAN NAME
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                QTY
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                UNIT PRICE
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                SETUP FEE
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                AMOUNT
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <label class="block">
                                    <select
                                        class="mt-6 w-full"
                                        x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})"
                                    >
                                        <option></option>
                                    </select>
                                </label>
                                <small>
                                    Select the plan for which you want to create a subscription for your customer.
                                </small>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="max-width:100px">
                                <label class="mt-1 flex -space-x-px">
                                    <div
                                        class="flex items-center justify-center rounded-l-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>-</span>
                                    </div>
                                    <input
                                        class="form-input w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="text"
                                    />
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>+</span>
                                    </div>
                                </label>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="max-width:100px">
                                <label class="block">
                                    <label class="mt-1 flex -space-x-px">
                                        <input
                                            class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            type="number"
                                        />
                                        <div
                                            class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                        >
                                            <span>₹</span>
                                        </div>
                                    </label>
                                </label>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="max-width:100px">
                                <label class="mt-1 flex -space-x-px">
                                    <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="number"
                                    />
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>₹</span>
                                    </div>
                                </label>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="max-width:100px">₹ 0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--   TODO Subscription Term Start on    --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mt-4">
                    <span>Subscription Term Start on <sup class="text-rose-500">*</sup></span>
                    <label class="mt-1 flex -space-x-px relative">
                        <input
                            x-init="$el._x_flatpickr = flatpickr($el,{enableTime: true})"
                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Choose datetime..."
                            type="text"
                        />
                        <span
                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                        >
                            <i class="fa-solid fa-calendar-days fa-2x"></i>
                        </span>
                    </label>
                    <small>
                        The subscription will start on this date.
                    </small>
                </label>
            </div>
        </div>
        {{--   TODO Add Subscription Reason  --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mt-4">
                    <span>Add Subscription Reason <sup class="text-rose-500">*</sup></span>
                    <label class="mt-1 flex -space-x-px relative">
                           <textarea
                               rows="4"
                               class="form-textarea w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                           ></textarea>
                    </label>
                    <small>
                        Add the subscription reason here. This will be displayed in the subscription table and also on
                        the individual subscription page. This can be used for future reference.
                    </small>
                </label>
            </div>
        </div>
        {{--   TODO Payment Method    --}}
        <div class="card m-4 p-4">
            <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Payment Method
            </h3>
            <div class="mt-4">
                <div>
                    <div>
                        <input
                            class="form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                            name="contact-preference" id="rb-email" type="radio" checked="checked"/>
                        <label class="label" for="rb-email">Offline Payment / Create Invoice</label> <br>
                        <small>
                            Choose this offline payment method to create the offline/manual subscription for any
                            customer. The invoice status would be sent. You can record the invoice from the invoice
                            section. Or you can create an invoice and send this to your customer to collect the payment.
                        </small>
                    </div>
                    <input
                        class="rb-payment-method form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                        name="contact-preference" id="rb-phone" type="radio"/>
                    <label class="label" for="rb-phone">Credit Card</label> <br>
                    <small>
                        Card list that is associated with this customer will be shown here. You can select the card to
                        collect the payment for this subscription.
                    </small>
                    <div class="payment-method mt-4">
                        <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 pt-4">
                            No cards found yet.
                        </h3>
                        <p class="mt-0">
                            To collect the payment via card, you can click on the "Add New Card" button below & can
                            share this link with your customers and can then select this card under this Add/Edit
                            subscription to process the payment.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{--  TODO Payment Term  --}}
        <h4 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 py-4">
            Payment Term
        </h4>
        <div class="border-t border-sky-200 py-3">
            <input
                class=" rb-payment-term form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                name="contact-preference" id="rb-phone" type="checkbox"/>
            <label class="label" for="rb-phone">Payment Term</label>
            <div class="payment-term">
                <div class="grid grid-cols-2 gap-4">
                    <div class=" mt-4">
                        <label class="block">
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                                <option>Net 0</option>
                                <option>Net 15</option>
                                <option>Due end of the month</option>
                                <option>Due end of next month</option>
                            </select>
                        </label>
                        <small>
                            The payment term period defines the time period within which the customer has to make payment for
                            the subscription . For example, if you select net 15 that means your customer has 15 more days to
                            make the payment from the subscription billing date. Similarly for Net 30, Net 45, Net 60.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4">
            <button
                class="btn space-x-2 border border-primary font-medium text-white bg-primary">
                Save
            </button>
            <button
                class="btn space-x-2 border border-primary font-medium text-primary mr-3">
                Cancel
            </button>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .payment-method {
            display: none;
        }

        .rb-payment-method:checked ~ .payment-method {
            display: inline;
        }

        .payment-term {
            display: none;
        }

        .rb-payment-term:checked ~ .payment-term {
            display: inline;
        }

    </style>
@endpush

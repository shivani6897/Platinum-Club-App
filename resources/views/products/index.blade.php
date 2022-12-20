@extends('layouts.app')
@section('heading', 'Products')

@section('content')
    <div class="products-container">
        <div class="mt-4 grid grid-cols-12 gap-4  transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="col-span-12 lg:col-span-4 ">
                <div class="bg-white card rounded-md py-4 ">
                    <div class="px-4 pb-4 flex-row items-center justify-between flex  border-b border-sky-200">
                        <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Products</h3>
                        {{--  TODO Add Product Model   --}}
                        <div x-data="{showModal:false}">
                            <button
                                @click="showModal = true"
                                class="btn px-2 py-1 space-x-2 border border-primary font-medium text-primary ">
                                <i class="fa-solid fa-circle-plus"></i>
                                <span>Add Product</span>
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
                                        class="relative max-w-md rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                                        x-show="showModal"
                                        x-transition:enter="easy-out"
                                        x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave="easy-in"
                                        x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                    >
                                        <div class="m-2">
                                            <div class="pt-2 pb-2">
                                                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                                                    Add Product
                                                </h2>
                                            </div>
                                            <label class="block">
                                                <span>Product Name</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    type="text"
                                                />
                                            </label>
                                            <p class="mt-2">
                                                Enter the product name. This name will be displayed on the checkout
                                                page.
                                            </p>
                                        </div>
                                        <div class="mt-4 text-right">
                                            <button
                                                class="btn space-x-2 border border-primary font-medium text-primary mr-3">
                                                Cancel
                                            </button>
                                            <button
                                                @click="showModal = false"
                                                class="btn space-x-2 border border-primary font-medium text-white bg-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <p class="text-md p-4">1 Products</p>
                    <div class=" mx-4 pl-4 pt-3  hover:bg-sky-100 hover:border-sky-500 border-l-2 border-white">
                        <div class="justify-between items-center flex mb-4">
                            <a href="#">
                                <p class="text-lg">Test</p>
                                <ul class="flex mt-2">
                                    <li>0 PLan</li>
                                    <li class="mx-2">0 Coupons</li>
                                    <li>0 Addons</li>
                                </ul>
                            </a>
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
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                                        />
                                    </svg>
                                </button>

                                <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                    <div
                                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                                    >
                                        <ul>
                                            <li>
                                                <a href="#"
                                                   class="flex  items-center px-3 h-8 pr-12 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                >Edit</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                   class="flex  items-center px-3 h-8 pr-12 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                >Delete</a>
                                            </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right pt-2  mt-2 border-t border-sky-200">
                        <select
                            class="form-select mt-1 h-8 w-14 mr-4  rounded-lg border border-slate-300 bg-white px-2.5 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>30</option>
                            <option>50</option>
                            <option>100</option>
                            <option>250</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8 ">
                <div class="bg-white rounded-md p-4 shadow-md">
                    {{--        TODO  Add PLam          --}}
                    <div class="border-b border-sky-200 pb-3">
                        <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Add Plan
                        </h3>
                        <div class="justify-between items-center flex">
                            <p>
                                A plan determines how a product is going to be sold. You can collect recurring payments,
                                collect set up fee,offer trial period and much more for your product.
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
                    <div class="mt-3">
                        <label class="block">
                            <span>Plan Name <sup class="text-rose-500">*</sup></span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                type="text"
                            />
                            <small>Enter the plan name. Please note that this will be displayed to customers on the
                                checkout page.</small>
                        </label>
                    </div>
                    {{--  TODO Trial  --}}
                    <h4 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 py-4">
                        Trial <sup class="text-rose-500">*</sup>
                    </h4>
                    <div class="border-t border-sky-200 py-3">
                        <input
                            class=" rb-trial form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                            name="contact-preference" id="rb-phone" type="checkbox"/>
                        <label class="label" for="rb-phone">Trial</label>
                        <div class="trial mt-4">
                            <div>
                                <label class="block mt-4">
                                    <span>Price <sup class="text-rose-500">*</sup></span>
                                    <label class="mt-1 flex -space-x-px">
                                        <input
                                            class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Enter price"
                                            type="number"
                                        />
                                        <div
                                            class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                        >
                                            <span>₹</span>
                                        </div>
                                    </label>
                                    <small>
                                        If want to charge an amount from your customers for the trial period, then enter
                                        the amount. For free trial, keep the amount as 0.
                                    </small>
                                </label>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div>
                                        <label class="block mt-4">
                                            <span>Number of Trial</span>
                                            <label class="mt-1 flex -space-x-px">
                                                <input
                                                    class="form-input  w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    type="number"
                                                />
                                            </label>
                                            <small>
                                                Enter the number of days/months for the trial period.
                                            </small>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <label class="block mt-4">
                                            <span>Period</span>
                                            <select
                                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                <option>Day</option>
                                                <option>Month</option>
                                            </select>
                                            <small>
                                                Choose days/months you want to offer as trial period.
                                            </small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  TODO Pricing  --}}
                    <h4 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 py-4">
                        Pricing <sup class="text-rose-500">*</sup>
                    </h4>
                    <div class="border-t border-sky-200 py-3">
                        <div class="my-4">
                            <label class="block mt-4">
                                <span>Price <sup class="text-rose-500">*</sup></span>
                                <label class="mt-1 flex -space-x-px">
                                    <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter price"
                                        type="number"
                                    />
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>₹</span>
                                    </div>
                                </label>
                                <small>
                                    The selling price of this Product (or the start price if this is a
                                    dimesale/timesale).
                                </small>
                            </label>
                            <div class="grid grid-cols-3 gap-4 mt-3">
                                <div>
                                    <label class="block ">
                                        Units 1 to
                                    </label>
                                </div>
                                <div>
                                    <label class="block ">
                                        <label class="mt-1 flex -space-x-px">
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                placeholder="& Above"
                                                type="number"
                                            />
                                        </label>
                                    </label>
                                </div>
                                <label class="mt-1 flex -space-x-px">
                                    <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3  placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="number"
                                    />
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>₹</span>
                                    </div>
                                </label>
                            </div>
                            <label class="block mt-4">
                                <span>Minimum Price <sup class="text-rose-500">*</sup></span>
                                <label class="mt-1 flex -space-x-px">
                                    <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter price"
                                        type="number"
                                    />
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100"
                                    >
                                        <span>₹</span>
                                    </div>
                                </label>
                                <small>
                                    You can mention the minimum amount to be paid by the customer.
                                </small>
                            </label>
                        </div>
                    </div>
                    {{--  TODO Billing Cycle  --}}
                    <h4 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 py-4">
                        Billing Cycle <sup class="text-rose-500">*</sup>
                    </h4>
                    <div class="border-t border-sky-200 py-3">
                        <div>
                            <div>
                                <input
                                    class="form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    name="contact-preference" id="rb-email" type="radio" checked="checked"/>
                                <label class="label" for="rb-email">One-Time</label>
                            </div>
                            <input
                                class="rb-billing-cycle form-radio is-outline h-5 w-5 rounded-full border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                name="contact-preference" id="rb-phone" type="radio"/>
                            <label class="label" for="rb-phone">EMI</label>
                            <div class="billing-cycle mt-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block">
                                            <span>Down Payment<sup class="text-rose-500">*</sup></span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="number"
                                            />
                                        </label>
                                        <small>
                                            Choose the billing frequency type. Example: To bill every 2 weeks up to 3
                                            billing cycles, add 2 in the bill every option, choose weeks from the
                                            dropdown and add 3 in the no. of billing cycles.
                                        </small>
                                    </div>
                                    <div>
                                        <label class="block">
                                            <span></span>
                                            <select
                                                class="form-select mt-7 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                <option>3 Month</option>
                                                <option>6 Month</option>
                                                <option>9 Month</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="block">
                                            <span>No. of Billing Cycles</span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="number"
                                            />
                                        </label>
                                        <div class="col-span-2">
                                            <small>
                                                Leave it blank to use the forever billing cycle type. </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  TODO Plan Description  --}}
                    <h4 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 py-4">
                        Plan Description <sup class="text-rose-500">*</sup>
                    </h4>
                    <div class="border-t border-sky-200 py-3">
                        <div class="mt-1.5 w-full">
                            <div
                                class="h-48"
                                x-init="$el._x_quill = new Quill($el,{
                            modules : {
                              toolbar: [
                                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                                ['blockquote', 'code-block'],
                                [{ header: 1 }, { header: 2 }], // custom button values
                                [{ list: 'ordered' }, { list: 'bullet' }],
                                [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
                                [{ indent: '-1' }, { indent: '+1' }], // outdent/indent
                                [{ direction: 'rtl' }], // text direction
                                [{ size: ['small', false, 'large', 'huge'] }], // custom dropdown
                                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                                [{ font: [] }],
                                [{ align: [] }],
                                ['clean'], // remove formatting button
                              ],
                            },
                            placeholder: 'Enter your content...',
                            theme: 'snow',
                          })"
                            ></div>
                            <small>
                                Enter a short description about the plan. You can customize the description by styling
                                the text and adding images as well. This will be shown on the checkout page. Image size
                                should be 400W x 250H, Max Size - 100kb.
                            </small>
                        </div>
                    </div>
                    {{--  TODO Payment Gateway   --}}
                    <div>
                        <label class="block mt-4">
                            <span>Payment Gateway </span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                                <option>All Gateway</option>
                                <option>Selected Gateway</option>
                            </select>
                        </label>
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
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .products-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }

        @media screen and (min-width: 370px) {
            .products-container {
                width: 100% !important;
            }
        }

        .billing-cycle {
            display: none;
        }

        .rb-billing-cycle:checked ~ .billing-cycle {
            display: inline;
        }

        .trial {
            display: none;
        }

        .rb-trial:checked ~ .trial {
            display: inline;
        }


    </style>
@endpush

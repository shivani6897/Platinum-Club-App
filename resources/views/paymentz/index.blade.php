<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

    <title>{{ config('app.name') }}</title>


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css"/>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <script src="https://cdn.tailwindcss.com/"></script>
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>

    <!-- Javascript Assets -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous"/>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    @stack('styles')
    @include('layouts.alertMsg')
    <style>
        .one-time {
            display: none;
        }

        /*.rb-one-time:checked ~ .one-time {*/
        /*    display: inline;*/
        /*}*/

    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div>
    <main class="container mx-auto mt-5">
        <div>
            <center>
                <p style="font-size: 2.5rem;font-weight: bold"
                   class="text-black"
                >Paymentz</p>
            </center>
            <div class="grid grid-cols-2 gap-6 mt-7">
                <div>
                    <div class="grid grid-cols-2 gap-4 ">
                        <div>
                            <label class="block">
                                <span class="text-black">Full Name:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text"
                                />
                            </label>
                            <label class="block mt-3">
                                <span class="text-black">Last Name:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text"
                                />
                            </label>

                        </div>
                        <div>
                            <label class="block">
                                <span class="text-black">Email:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="email"
                                />
                            </label>
                            <label class="block mt-3">
                                <span class="text-black">Phone No:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="number"
                                />
                            </label>

                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="block">
                            <span class="text-black">Product</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300  px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 bg-transparent dark:hover:border-navy-400 dark:focus:border-accent">
                                <option>Product 1 (1,00,000,00)</option>
                                <option>Product 2 (1,00,000,00)</option>
                                <option>Product 3 (1,00,000,00)</option>
                                <option>Product 4 (1,00,000,00)</option>
                            </select>
                        </label>
                    </div>
                    <div class="mt-6">
                        <label class="inline-flex items-center space-x-2">
                            <input
                                class="rb-one-time form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                name="basic"
                                onclick="oneTime()"
                                type="radio"/>
                            <p>One-time</p>
                        </label>
                        <label class="inline-flex items-center space-x-2 ml-4">
                            <input
                                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                name="basic" checked
                                type="radio"/>
                            <p>EMI</p>
                        </label>
                        <div class="one-time hidden">
                            <label class="block mt-4">
                                <span>Price <sup class="text-rose-500">*</sup></span>
                                <label class="mt-1 flex -space-x-px">
                                    <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter price"
                                        type="number"/>
                                    <div
                                        class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-slate-150 px-3.5 font-inter text-slate-800 dark:border-navy-450 dark:bg-navy-500 dark:text-navy-100">
                                        <span>₹</span>
                                    </div>
                                </label>
                            </label>
                        </div>
                        <div class="emi-payment">
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <label class="block">
                                    <span class="text-black">What is your Downpayment? (Min 20,000.00/-)</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="text"/>
                                </label>
                                <label class="block">
                                    <span class="text-black">How many EMI do you Need?</span>
                                    <select
                                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300  px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 bg-transparent dark:hover:border-navy-400 dark:focus:border-accent">
                                        <option>13,333 * 6 Months</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-7">
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="border border-b-slate-200 rounded-md  flex justify-center">
                                <img src="{{asset('images/payment/stripe_logo.png')}}" alt="">
                            </div>
                            <div class="border border-b-slate-200 rounded-md  flex justify-center items-center">
                                <img src="{{asset('images/payment/razorpay_logo.png')}}" alt=""
                                     style="width: 70%;height: 40px"/>
                            </div>
                            <div class="border border-b-slate-200 rounded-md  flex justify-center items-center">
                                <img src="{{asset('images/payment/instamojo.png')}}" alt=""
                                     style="width: 70%;height: 40px"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="inline-flex items-center space-x-2">
                            <input
                                class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                type="checkbox"
                            />
                            <p class="text-black">I hereby agree to make the monthly Emi of Rs 13,333.00/-</p>
                        </label>
                        <div class="mt-5">
                            <button class="btn bg-green-400 font-medium text-white py-4 px-7 rounded-xl text-lg">
                                Pay Now
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="{{asset('images/payment/marketing-online.png')}}" alt="" style="width: 100%;"/>
                        <div class="mt-3">
                            <p class="text-black">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium consequuntur
                                cupiditate fugiat harum illo, laborum magnam maiores neque odio quaerat quibusdam
                                quidem, recusandae reiciendis sed veritatis vero vitae voluptate.
                            </p>
                            <ul style="list-style: disc" class="text-black mt-3 ml-3">
                                <li> Lorem ipsum dolor sit amet, </li>
                                <li>  ipsum dolor sit amet, </li>
                                <li> dolor sit amet, </li>
                            </ul>
                            <p class="text-black mt-2">
                                when an unknown printer took a galley of type and scrambled it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function oneTime() {
        if ($('.rb-one-time').is(":checked"))
            $(".one-time").show();
        else
            $(".one-time").hide();
    }
</script>
</body>

</html>

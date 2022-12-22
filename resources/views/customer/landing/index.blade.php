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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <script src="https://cdn.tailwindcss.com/"></script>
    <!-- CSS Assets -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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

        .select2-container--default .select2-selection--single {
                padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0.75rem;
    padding-right: 0.75rem;
    --tw-border-opacity: 1;
    border-color: rgb(203 213 225 / var(--tw-border-opacity));
    border-width: 1px;
        border-radius: 0.5rem;
            width: 100%;
            margin-top: 0.375rem;
            height: 45px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 15px;
        }

    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div>
    <form>
    <main class="container mx-auto p-10">
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
                                <span class="text-black">First Name:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text"
                                    name="first_name"
                                    required
                                />
                            </label>
                            <label class="block mt-3">
                                <span class="text-black">Last Name:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text"
                                    name="last_name"
                                    required
                                />
                            </label>

                        </div>
                        <div>
                            <label class="block">
                                <span class="text-black">Email:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    name="email"
                                    type="email"
                                    required
                                />
                            </label>
                            <label class="block mt-3">
                                <span class="text-black">Phone No:</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    name="phone_no"
                                    type="number"
                                    required
                                />
                            </label>

                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="block">
                            <span class="text-black">Product</span>
                            <select
                                id="product"
                                name="product_id"
                                class="select2 form-select mt-1.5 w-full rounded-lg border border-slate-300  px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 bg-transparent dark:hover:border-navy-400 dark:focus:border-accent">
                                @foreach($products as $product)
                                <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name}} (₹ {{$product->price}})</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="mt-6">
                        <label class="inline-flex items-center space-x-2">
                            <input
                                class="rb-one-time form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                name="basic" checked
                                onclick="showEmi(0)"
                                type="radio"/>
                            <p>One-time</p>
                        </label>
                        <label class="inline-flex items-center space-x-2 ml-4">
                            <input
                                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                name="basic"
                                onclick="showEmi(1)"
                                type="radio"/>
                            <p>EMI</p>
                        </label>
                        {{-- <div class="">
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
                        </div> --}}
                        <div class="emi-payment hidden">
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <label class="block">
                                    <span class="text-black">What is your Downpayment? (Min <span id="min-downpayment-span">{{$selectedProduct->downpayment}}</span>/-)</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="number"
                                        name="downpayment"
                                        min="{{$selectedProduct->downpayment}}"
                                        value="{{$selectedProduct->downpayment}}"
                                        step="0.01"
                                        required
                                        />
                                </label>
                                <label class="block">
                                    <span class="text-black">How many EMI do you Need?</span>
                                    <select
                                        id="emi-value"
                                        name="emi"
                                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300  px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 bg-transparent dark:hover:border-navy-400 dark:focus:border-accent">
                                        @php
                                            $pending = $selectedProduct->price-$selectedProduct->downpayment;
                                            echo "<option value='3' data-emi='".number_format($pending/3,2)."'>₹".number_format($pending/3,2)." * 3 Months</option>";
                                            echo "<option value='6' data-emi='".number_format($pending/6,2)."'>₹".number_format($pending/6,2)." * 6 Months</option>";
                                            echo "<option value='12' data-emi='".number_format($pending/12,2)."'>₹".number_format($pending/12,2)." * 12 Months</option>";
                                        @endphp
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
                                required
                            />
                            <p id="agree-label" class="text-black">I hereby agree to pay Rs <span id="emi-amount">{{$selectedProduct->price}}</span>/-</p>
                            {{-- <p class="text-black">I hereby agree to make the monthly Emi of Rs <span id="emi-amount">13,333.00</span>/-</p> --}}
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
                        <img id="product-img" src="{{($products[0]->image?asset('/images/products/'.$products[0]->image):'')}}" alt="" style="width: 100%;"/>
                        <div id="product-desc" class="mt-3">
                            {!! $products[0]->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    var products = {!! json_encode($products) !!};
    // function oneTime() {
    //     if ($('.rb-one-time').is(":checked"))
    //         $(".one-time").show();
    //     else
    //         $(".one-time").hide();
    // }
    function showEmi(flg)
    {
        if(flg)
        {
            $('.emi-payment').slideDown('slow');
            $('#agree-label').html('I hereby agree to make the monthly Emi of Rs <span id="emi-amount">'+$('select[name="emi"]:selected').data('emi')+'</span>');
        }
        else
        {
            $('.emi-payment').slideUp('slow');
            $('#agree-label').html('I hereby agree to make the monthly Emi of Rs <span id="emi-amount">'+$('select[name="product_id"]:selected').data('price')+'</span>');
        }
    }
    $(document).ready(function(){
        $('.select2').select2();
        $('#product').change(function(){
            $.ajax({
                url: '{{url('/landing/'.$id.'/product')}}/'+$(this).val(),
                success: function(result) {
                    if(result.status)
                    {
                        console.log(result);
                        if(result.data.image!='' && result.data.image!=null && result.data.image!=undefined)
                            $('#product-img').attr('src','{{url('/images/products/')}}/'+result.data.image);
                        else
                            $('#product-img').attr('src','');

                        $('#product-desc').html(result.data.description);
                        $('input[name="downpayment"]').attr('min',result.data.downpayment).val(result.data.downpayment);
                        $('#min-downpayment-span').html(result.data.downpayment);
                        $('#emi-value').empty().append(`<option value="3">₹``3 Months</option>`);



                    }
                    else
                        console.error(result.message);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })
    })
</script>
</body>

</html>

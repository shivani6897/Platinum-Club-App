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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script> --}}

    <script src="https://cdn.tailwindcss.com/"></script>
    <!-- CSS Assets -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
    {{-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" /> --}}
    {{-- <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js" defer></script> --}}

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

        .gateway-button {
            cursor: pointer;
            transition: all .2s;
        }

        .gateway-button.selected {
            border: 3px solid #0a86df;
        }

        #stripeModal {
            background: rgba(0, 0, 0, 0.7);
        }

        #stripeModal > div {
            margin: auto;
        }

        #stripeModal > div > div {
            /*margin-top: 50%;
          transform: translateY(-50%);*/
        }

    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div>
    <form id="paymentForm" method="post" action="{{request()->fullUrlWithQuery([])}}">
        @csrf
        <main class="container mx-auto md:p-10 p-4">
            <div>
                <center>
                    <p style="font-size: 2.5rem;font-weight: bold"
                       class="text-black"
                    >Paymentz</p>
                </center>
                <div class="grid md:grid-cols-2 md:gap-6 mt-7">
                    <div>
                        <div class="grid md:grid-cols-2 md:gap-4 ">
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
                            <div class="mt-3 md:mt-0">
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
                                        <option value="{{$product->id}}"
                                                data-price="{{$product->price}}">{{$product->name}}
                                            (₹ {{$product->price}})
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="mt-6">
                            <label class="inline-flex items-center space-x-2 one_time-field">
                                <input
                                    class="rb-one-time form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                    name="payment_type" checked
                                    value="0"
                                    onclick="showEmi(0)"
                                    type="radio"/>
                                <p>One-time</p>
                            </label>
                            @if($selectedProduct->emi ==1)
                                <label class="inline-flex items-center space-x-2 ml-4 emi-field">
                                    <input
                                        class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                        name="payment_type"
                                        value="1"
                                        onclick="showEmi(1)"
                                        type="radio"/>
                                    <p>EMI</p>
                                </label>
                            @endif
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
                                <div class="grid lg:grid-cols-2 lg:gap-4 mt-6">
                                    <label class="block">
                                        <span class="text-black">What is your Downpayment? (Min <span
                                                id="min-downpayment-span">{{$selectedProduct->downpayment}}</span>/-)</span>
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
                                    <label class="block mt-3 lg:mt-0">
                                        <span class="text-black">How many EMI do you Need?</span>
                                        <select
                                            id="emi-value"
                                            name="emi"
                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300  px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 bg-transparent dark:hover:border-navy-400 dark:focus:border-accent">
                                            @php
                                                $pending = $selectedProduct->price-$selectedProduct->downpayment;
                                                echo "<option value='3' data-emi='".number_format($pending/3,2)."' selected>₹".number_format($pending/3,2)." * 3 Months</option>";
                                                echo "<option value='6' data-emi='".number_format($pending/6,2)."'>₹".number_format($pending/6,2)." * 6 Months</option>";
                                                echo "<option value='12' data-emi='".number_format($pending/9,2)."'>₹".number_format($pending/9,2)." * 9 Months</option>";
                                            @endphp
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-7 payment-options">
                            <input type="hidden" name="gateway" id="payment-gateway"
                                   value="{{($gateway->stripe_active==1?'stripe':'razorpay')}}">
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                @if($gateway->stripe_active==1)
                                    <div onclick="selectGateway(this,'stripe')"
                                         class="gateway-button selected border border-b-slate-200 rounded-md  flex justify-center">
                                        <img src="{{asset('images/payment/stripe_logo.png')}}" alt="">
                                    </div>
                                @endif
                                @if($gateway->razorpay_active==1)
                                    <div onclick="selectGateway(this,'razorpay')"
                                         class="gateway-button {{ ($gateway->stripe_active==0?'selected':'') }} border border-b-slate-200 rounded-md  flex justify-center items-center">
                                        <img src="{{asset('images/payment/razorpay_logo.png')}}" alt=""
                                             style="width: 70%;height: 40px"/>
                                    </div>
                                @endif
                                @if(@$gateway->instamojo_active==1)
                                    <div onclick="selectGateway(this,'instamojo')"
                                         class="gateway-button border border-b-slate-200 rounded-md flex justify-center items-center">
                                        <img src="{{asset('images/payment/instamojo.png')}}" alt=""
                                             style="width: 70%;height: 40px"/>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Free Trial -->
                        <div class="is_free_trial" style="{{$selectedProduct->is_free_trial ? '' : 'display:none;'}}">   
                            <label class="inline-flex items-center space-x-2 mt-5">
                                <input
                                  class="form-switch h-7 w-14 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
                                  type="radio"
                                  name="is_free_trial"
                                  data-trial_fee="{{$selectedProduct->trial_price}}"
                                  {{$selectedProduct->is_free_trial ? 'checked' : ''}}
                                />
                                <span class="text-base">Free Trial</span>
                            </label>
                            <div
                                class="alert flex rounded-lg bg-info/10 py-4 px-4 text-info dark:bg-info/15 sm:px-5 mt-2"
                            >   
                                <i class="fa-sharp fa-solid fa-circle-info" style="margin-top:3px;"></i> 
                                <p class="free_trial_msg">&nbsp;
                                    @if($selectedProduct->trial_price != 0)
                                        Rs {{$selectedProduct->trial_price}} will be charge for trial period.
                                    @else
                                        You will not be charged until your trial ends.
                                    @endif
                                    Your trial period ends after <b>{{$selectedProduct->trial_duration}} {{$selectedProduct->trial_duration_type}}</b>
                                </p>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label class="inline-flex items-center space-x-2">
                                <input
                                    class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox"
                                    required
                                />
                                <p id="agree-label" class="text-black">I hereby agree to make payment
                                    Rs {{$selectedProduct->price}}/-</p>
                                <p id="tax-detail"></p>
                                {{-- <p class="text-black">I hereby agree to make the monthly Emi of Rs <span id="emi-amount">13,333.00</span>/-</p> --}}
                            </label>
                            <div class="mt-5">
                                <button type="button" onclick="payAttempt(this)"
                                        class="btn bg-green-400 font-medium text-white py-4 px-7 rounded-xl text-lg payNowBtn">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0">
                        <div>
                            <img id="product-img"
                                 src="{{($products[0]->image?asset('/images/products/'.$products[0]->image):'')}}"
                                 alt="" style="width: 100%;"/>
                            <div id="product-desc" class="mt-3 reset">
                                {!! $products[0]->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</div>


<!-- Modal toggle -->
{{-- <div id="stripeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Stripe Payment</h4>
      </div>
      <div class="modal-body">
        <div id="stripeForm"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Pay</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> --}}
<div id="stripeModal" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Stripe Payment
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeModal('#stripeModal')">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div id="stripeForm"></div>
                <div id="payment-message" class="hidden"></div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" onclick="payUsingStripe(this)"
                        class="btn bg-green-400 font-medium text-white py-4 px-7 rounded-xl text-lg pay-btn">
                    Pay Now
                </button>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


{{-- General Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var backURL = '{{url('/landing/'.$id.'/stripe/success')}}';
    var newUrl = '';
    var razorpayBackURL = '{{url('/landing/'.$id.'/razorpay/success')}}';
    var razorpayNewUrl = '';
    var products = {!! json_encode($products) !!};
    // function oneTime() {
    //     if ($('.rb-one-time').is(":checked"))
    //         $(".one-time").show();
    //     else
    //         $(".one-time").hide();
    // }
    function closeModal(id) {
        $(id).hide();
    }

    function setPayNowBtnLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector(".payNowBtn").disabled = true;
            document.querySelector(".payNowBtn").innerHTML = "Loading...";
        } else {
            document.querySelector(".payNowBtn").disabled = false;
            document.querySelector(".payNowBtn").innerHTML = "Pay Now";
        }
    }

    function payAttempt(obj) {
        document.getElementById('paymentForm').reportValidity()
        if (document.getElementById('paymentForm').checkValidity()) {

            var payingAmount = 0;
            if($('input[name="is_free_trial"]').is(':checked')){
                payingAmount = $('input[name="is_free_trial"]').data('trial_fee');
            }else{
                if ($('input[name="payment_type"]:checked').val() == 0)
                    payingAmount = $('select[name="product_id"]').find(':selected').data('price');
                else
                    payingAmount = $('input[name="downpayment"]').val()
            }
            if ($('#payment-gateway').val() == 'stripe') {
                newUrl = backURL + "?" + $('#paymentForm').serialize();
                stripeUpdatePaymentIntent(payingAmount);
                setLoading(false);
                $('#stripeModal').show();
            } else if ($('#payment-gateway').val() == 'razorpay') {
                razorpayNewUrl = razorpayBackURL + "?" + $('#paymentForm').serialize();
                razorpayCreateOrder(payingAmount);
            } else if ($('#payment-gateway').val() == 'instamojo') {
                document.getElementById('paymentForm').submit();
            }
            else{
                document.getElementById('paymentForm').submit();
                setPayNowBtnLoading(true);
            }
        }
    }

    function showEmi(flg) {
        if (flg) {
            $('.emi-payment').slideDown('slow');
            $('#agree-label').html('I hereby agree to make the monthly Emi of Rs <span id="emi-amount">' + $('select[name="emi"]').find(':selected').data('emi') + '</span>');
        } else {
            $('.emi-payment').slideUp('slow');
            $('#agree-label').html('I hereby agree to make payment of Rs ' + $('select[name="product_id"]').find(':selected').data('price'));
        }
    }

    function selectGateway(obj, strData) {
        $('.gateway-button').removeClass('selected');
        $(obj).addClass('selected');
        $('#payment-gateway').val(strData);
    }

    $(document).ready(function () {
        $('.select2').select2();
        $('#product').change(function () {
            $.ajax({
                url: '{{url('/landing/'.$id.'/product')}}/' + $(this).val(),
                beforeSend: function(){
                    setPayNowBtnLoading(true);
                },
                success: function (result) {
                    if (result.status) {
                        if (result.data.emi == 1) {
                            $('.emi-field').slideDown('slow');
                        } else {
                            $('.emi-field').slideUp('slow');
                        }

                        freeTrialChanges(result);
                        
                        pending = parseInt(result.data.price) - parseInt(result.data.downpayment);
                        if (result.data.image != '' && result.data.image != null && result.data.image != undefined)
                            $('#product-img').attr('src', '{{url('/images/products/')}}/' + result.data.image);
                        else
                            $('#product-img').attr('src', '');

                        $('#product-desc').html(result.data.description);
                        $('input[name="downpayment"]').attr('min', result.data.downpayment).val(result.data.downpayment);
                        $('#min-downpayment-span').html(result.data.downpayment);
                        $('#emi-value').empty().append(`<option value="3" data-emi="` + Math.round(pending / 3, 2) + `">₹` + Math.round(pending / 3, 2) + ` * 3 Months</option>
                            <option value="6" data-emi="` + Math.round(pending / 6, 2) + `">₹` + Math.round(pending / 6, 2) + ` * 6 Months</option>
                            <option value="9" data-emi="` + Math.round(pending / 9, 2) + `">₹` + Math.round(pending / 9, 2) + ` * 9 Months</option>`).trigger('change');

                        if ($('input[name="payment_type"]:checked').val() == 1) {
                            $('.emi-payment').slideDown('slow');
                            $('#agree-label').html('I hereby agree to make the monthly Emi of Rs <span id="emi-amount">' + $('select[name="emi"]').find(':selected').data('emi') + '</span>');
                        } else {
                            $('.emi-payment').slideUp('slow');
                            $('#agree-label').html('I hereby agree to make payment of Rs ' + $('select[name="product_id"]').find(':selected').data('price'));
                        }
                        if (result.data.tax !== null && result.data.tax !== undefined)
                            $('#tax-detail').html('(' + result.data.tax + ' % GST inclusive)');
                        else
                            $('#tax-detail').html('');
                    } else
                        console.error(result.message);
                },
                error: function (error) {
                    console.error(error);
                },
                complete: function(){
                    setPayNowBtnLoading(false);
                }
            })
        });
        $('#emi-value').change(function () {
            $('#emi-amount').html($(this).find(':selected').data('emi'));
        })
        $('input[name="downpayment"]').keyup(function () {
            pending = parseInt($('select[name="product_id"]').find(':selected').data('price')) - parseInt($(this).val());
            $('#min-downpayment-span').html($(this).val());
            $('#emi-value').empty().append(`<option value="3" data-emi="` + Math.round(pending / 3, 2) + `">₹` + Math.round(pending / 3, 2) + ` * 3 Months</option>
              <option value="6" data-emi="` + Math.round(pending / 6, 2) + `">₹` + Math.round(pending / 6, 2) + ` * 6 Months</option>
              <option value="9" data-emi="` + Math.round(pending / 9, 2) + `">₹` + Math.round(pending / 9, 2) + ` * 9 Months</option>`).trigger('change')
        });

    })

    {{-- Razorpay Scripts --}}
    function razorpayCreateOrder(amount) {
        $.ajax({
            url: '{{url('/landing/'.$id.'/razorpay/create-order')}}/' + amount,
            method: 'post',
            data: {
                _token: '{{csrf_token()}}',
                email: $('input[name="email"]').val(),
                payment_type: $('input[name="payment_type"]:checked').val()
            },
            success: function (result) {
                if (result.status) {
                    var options = {
                        "key": "{{$gateway->razorpay_key}}", // Enter the Key ID generated from the Dashboard
                        "amount": parseInt(amount) * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "{{config('app.name')}}",
                        "image": "{{asset('/images/app-logo.png')}}",
                        "order_id": result.order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "callback_url": razorpayNewUrl,
                        "prefill": {
                            "name": $('input[name="first_name"]').val() + ' ' + $('input[name="last_name"]').val(),
                            "email": $('input[name="email"]').val(),
                            "contact": $('input[name="phone_no"]').val()
                        },
                        "notes": {
                            // "address": "Razorpay Corporate Office"
                        },
                        "theme": {
                            "color": "#0a83e3"
                        }

                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
                console.log(result);
            },
            error: function (e) {
                console.error(e);
            }

        })
    }

    {{-- Stripe Scripts --}}
    const stripe = Stripe("{{$gateway->stripe_public}}");
    var paymentIntent = '';

    // Fetches a payment intent and captures the client secret
    async function initialize() {
        const {clientSecret} = await fetch("{{url('/landing/'.$id.'/stripe/payment-intent')}}/1", {
            method: "post",
            headers: {"Content-Type": "application/json"},
            body: {
                _token: '{{csrf_token()}}'
            },
        }).then((r) => r.json());
        const appearence = {
            theme: 'flat'
        };

        paymentIntent = clientSecret;
        $('input[name="paymentIntent"]').val(clientSecret);
        elements = stripe.elements({clientSecret, appearence});

        const paymentElementOptions = {
            layout: "tabs",
        };

        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#stripeForm");
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: newUrl,
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector(".pay-btn").disabled = true;
            document.querySelector(".pay-btn").innerHTML = "Loading...";
        } else {
            document.querySelector(".pay-btn").disabled = false;
            document.querySelector(".pay-btn").innerHTML = "Submit";
        }
    }

    function payUsingStripe(obj) {
        $('#paymentForm').submit(function (e) {
            handleSubmit(e);
        })
        $('#paymentForm').submit();
    }

    function stripeUpdatePaymentIntent(amount) {
        $.ajax({
            url: "{{url('/landing/'.$id.'/stripe/payment-intent')}}/" + amount,
            method: "post",
            data: {
                _token: '{{csrf_token()}}',
                paymentIntent: paymentIntent,
            },
            success: function (result) {
                // const { clientSecret } = JSON.parse(result);

                // elements = stripe.elements({ clientSecret });
                // const paymentElementOptions = {
                //   layout: "tabs",
                // };

                // const paymentElement = elements.create("payment", paymentElementOptions);
                // paymentElement.mount("#stripeForm");
                // handleSubmit(event);
            },
            error: function (e) {
                console.error(e);
            }
        });
    }

    initialize();

    function freeTrialChanges(response) {
        if (response.data.is_free_trial == 1){
            $('.is_free_trial').slideDown('slow');
            $('input[name="is_free_trial"]').prop('checked', true);
            $('input[name="is_free_trial"]').attr('data-trial_fee', response.data.trial_price);
            $('.free_trial_msg').html(response.data.trial_msg);

            if (response.data.trial_price != 0){
                $('.payment-options').slideDown('slow');
                $('#payment-gateway').val('stripe');
            }else{
                $('.payment-options').slideUp('slow');
                $('#payment-gateway').val('');
            }

        }else{
            $('input[name="is_free_trial"]').prop('checked', false);
            $('.is_free_trial').slideUp('slow');
            $('.payment-options').slideDown('slow');
            $('#payment-gateway').val('stripe');
        }
    }

</script>

</body>

</html>

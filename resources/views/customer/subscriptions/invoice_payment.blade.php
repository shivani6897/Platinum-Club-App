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
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script> --}}

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
    background: rgba(0,0,0,0.7);
    }
    #stripeModal>div {
      margin: auto;
    }
    #stripeModal>div>div {
      /*margin-top: 50%;
    transform: translateY(-50%);*/
    }

    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div>
    <form id="paymentForm">
    <main class="container mx-auto md:p-10 p-4">
        <div>
            <center>
                <p style="font-size: 2.5rem;font-weight: bold"
                   class="text-black"
                >Paymentz</p>
            </center>
            <div class="grid md:grid-cols-2 md:gap-6 mt-7">
                <div>
                    <div class="mt-7">
                        <input type="hidden" name="gateway" id="payment-gateway" value="{{($gateway->stripe_active==1?'stripe':'razorpay')}}">
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="invoiceId" value="{{$invoiceId}}">
                        <input type="hidden" name="rinvoiceId" value="{{$rinvoiceId}}">
                        <input type="hidden" name="payable_amount" value="{{$amount}}">
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            @if($gateway->stripe_active==1)
                            <div onclick="selectGateway(this,'stripe')" class="gateway-button selected border border-b-slate-200 rounded-md  flex justify-center">
                                <img src="{{asset('images/payment/stripe_logo.png')}}" alt="">
                            </div>
                            @endif
                            @if($gateway->razorpay_active==1)
                            <div onclick="selectGateway(this,'razorpay')" class="gateway-button {{ ($gateway->stripe_active==0?'selected':'') }} border border-b-slate-200 rounded-md  flex justify-center items-center">
                                <img src="{{asset('images/payment/razorpay_logo.png')}}" alt=""
                                     style="width: 70%;height: 40px"/>
                            </div>
                            @endif
                            {{-- <div onclick="selectGateway(this,'instamojo')" class="gateway-button border border-b-slate-200 rounded-md  flex justify-center items-center">
                                <img src="{{asset('images/payment/instamojo.png')}}" alt=""
                                     style="width: 70%;height: 40px"/>
                            </div> --}}
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="inline-flex items-center space-x-2">
                            <input
                                class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                type="checkbox"
                                required
                            />
                            <p id="agree-label" class="text-black">I hereby agree to make payment Rs {{$amount}}/-</p>
                            {{-- <p class="text-black">I hereby agree to make the monthly Emi of Rs <span id="emi-amount">13,333.00</span>/-</p> --}}
                        </label>
                        <div class="mt-5">
                            <button type="button" onclick="payAttempt(this)" class="btn bg-green-400 font-medium text-white py-4 px-7 rounded-xl text-lg">
                                Pay Now
                            </button>
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
<div id="stripeModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Stripe Payment
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal('#stripeModal')">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div id="stripeForm"></div>
                <div id="payment-message" class="hidden"></div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" onclick="payUsingStripe(this)" class="btn bg-green-400 font-medium text-white py-4 px-7 rounded-xl text-lg pay-btn">
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
    var backURL = '{{url('/invoices/payment/'.$id.'/'.$invoiceId.'/'.$rinvoiceId.'/stripe/success')}}';
    var newUrl = '';
    var razorpayBackURL = '{{url('/invoices/payment/'.$id.'/'.$invoiceId.'/'.$rinvoiceId.'/razorpay/success')}}';
    var razorpayNewUrl = '';
    function closeModal(id)
    {
      $(id).hide();
    }
    function payAttempt(obj)
    {
        if($('#payment-gateway').val()=='stripe')
        {
          newUrl = backURL + "?" + $('#paymentForm').serialize();
          stripeUpdatePaymentIntent({{$amount}});
          setLoading(false);
          $('#stripeModal').show();
        }
        else if($('#payment-gateway').val()=='razorpay')
        {
          razorpayNewUrl = razorpayBackURL + "?" + $('#paymentForm').serialize();
          razorpayCreateOrder({{$amount}});
        }
        else if($('#payment-gateway').val()=='instamojo')
        {

        }
    }
    function selectGateway(obj,strData)
    {
        $('.gateway-button').removeClass('selected');
        $(obj).addClass('selected');
        $('#payment-gateway').val(strData);
    }

{{-- Razorpay Scripts --}}
function razorpayCreateOrder(amount)
{
  $.ajax({
    url: '{{url('/landing/'.$id.'/razorpay/create-order')}}/'+amount,
    method: 'post',
    data: {
      _token: '{{csrf_token()}}',
      email: $('input[name="email"]').val(),
      payment_type: $('input[name="payment_type"]:checked').val()
    },
    success: function(result) {
      if(result.status)
      {
        var options = {
          "key": "{{$gateway->razorpay_key}}", // Enter the Key ID generated from the Dashboard
          "amount": parseInt(amount)*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
          "currency": "INR",
          "name": "{{config('app.name')}}",
          "image": "{{asset('/images/app-logo.png')}}",
          "order_id": result.order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
          "callback_url": razorpayNewUrl,
          @if(!empty($customer))
          "prefill": {
              "name": '{{$customer->name}}',
              "email": '{{$customer->email}}',
              "contact": '{{$customer->phone_no}}'
          },
          @endif
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
    error: function(e) {
      console.error(e);
    }

  })
}

{{-- Stripe Scripts --}}
  const stripe = Stripe("{{$gateway->stripe_public}}");
  var paymentIntent = '';

  // Fetches a payment intent and captures the client secret
async function initialize() {
  const { clientSecret } = await fetch("{{url('/landing/'.$id.'/stripe/payment-intent/'.$amount)}}", {
    method: "post",
    headers: { "Content-Type": "application/json" },
    body: {
      _token: '{{csrf_token()}}'
    },
  }).then((r) => r.json());
  const appearence = {
    theme: 'flat'
  };

  paymentIntent = clientSecret;
  $('input[name="paymentIntent"]').val(clientSecret);
  elements = stripe.elements({ clientSecret,appearence });

  const paymentElementOptions = {
    layout: "tabs",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#stripeForm");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
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

function payUsingStripe(obj)
{
  $('#paymentForm').submit(function(e){
    handleSubmit(e);
  })
  $('#paymentForm').submit();
}

function stripeUpdatePaymentIntent(amount)
{
  $.ajax({
        url: "{{url('/landing/'.$id.'/stripe/payment-intent')}}/"+amount,
        method: "post",
        data: {
          _token: '{{csrf_token()}}',
          paymentIntent: paymentIntent,
        },
        success: function(result) {
          // const { clientSecret } = JSON.parse(result);

          // elements = stripe.elements({ clientSecret });
          // const paymentElementOptions = {
          //   layout: "tabs",
          // };

          // const paymentElement = elements.create("payment", paymentElementOptions);
          // paymentElement.mount("#stripeForm");
          // handleSubmit(event);
        },
        error: function(e) {
          console.error(e);
        }
      });
}

initialize();

</script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

    <title>{{ config('app.name') }}</title>

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
    {{-- @vite('resources/css/app.css') --}}
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div style="padding-bottom: 50px">
    <main class="sm:w-8/12 sm:mx-auto">
        <div>
            <div class="mt-7 pt-5">
                <div class="rounded-lg p-5 bg-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <p>
                                Due Amount
                            </p>
                            <p class="text-3xl text-black font-bold">
                                ₹ {{number_format($data['due'],2)}}
                            </p>
                            {{-- <label class="mt-1.5 flex -space-x-px">
                                <div
                                    class="flex items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450"
                                >
                                    <span class="-mt-1">₹</span>
                                </div>
                                <input
                                    class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Due Amount"
                                    type="text"
                                    value="{{number_format($data['due'],2)}}"
                                    required
                                />
                            </label> --}}
                        </div>
                        @if($data['status']==0 && $data['emi']<$data['total_emis'])
                        <a href="{{route('invoices.payment.page',['id'=>$id,'invoiceId'=>$invoiceId,'rinvoiceId'=>$rinvoiceId,'amount'=>$data['due']])}}" class="btn bg-green-400 font-medium text-white py-2 px-5 rounded-lg text-md">
                            Pay Now
                        </a>
                        @else
                        <span class="text-success">Paid</span>
                        @endif
                    </div>
                </div>
                <div class="mt-4 rounded-lg  bg-white" style="padding-bottom: 150px">
                    <center><p class="text-2xl  text-black font-bold pt-5">Invoice</p></center>
                    <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;padding-top: 50px">
                        <div class="px-5">
                            <div class="justify-between flex">
                                <p class="text-md font-bold text-black">
                                    Member
                                </p>
                                <p class="text-md font-bold text-black">
                                    Invoice No: {{$data['invoice_number']}}
                                </p>
                                <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">
                                <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">
                            </div>

                            <div class="justify-between flex">
                                <p class="text-md font-bold text-black">
{{--                                    @if($data['userdetails']?->business_name)--}}
                                        Name of Company: {{$data['userdetails']?->business_name}}
{{--                                    @endif--}}
                                </p>

                                <p class="text-md font-bold text-black">
{{--                                    @if($data['user']?->email)--}}
                                        Email: {{$data['user']?->email}}
{{--                                    @endif--}}
                                </p>
{{--                                <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">--}}
{{--                                <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">--}}
                            </div>

                            <div class="sm:justify-between sm:flex">
                                <span class="flex items-center text-md">
{{--                                    @if($data['user']?->phone_no)--}}
                                        <p class="text-md font-bold text-black mr-2">Phone :</p>{{ $data['user']?->phone_no }}
{{--                                    @endif--}}
                                </span>
                                <span class="flex items-center text-md">
{{--                                    @if( $data['business_address'] )--}}
                                        <p class="text-md font-bold text-black mr-2">Address :</p>{{ isset($userdetails->business_address) ? $userdetails?->business_address . ', ' . $userdetails?->business_city . ', ' . $userdetails?->business_state . ', ' . $userdetails?->business_country :'' }}
{{--                                    @endif--}}
                                </span>
                            </div>
                            <div class="sm:justify-between sm:flex">
                                <span class="flex items-center text-md">
{{--                                    @if( $data['userdetails']?->business_gst_no )--}}
                                        <p class="text-md font-bold text-black mr-2">GST Number :</p>{{  $data['userdetails']?->business_gst_no }}
{{--                                    @endif--}}
                                </span>
{{--                                <span class="flex items-center text-md">--}}
{{--                                    <span class="text-md font-bold text-black mr-2">Gateway :</span> {{ $data['paid_by'] }}--}}
{{--                                </span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;padding-top: 50px">
                        <div class="px-5">
                            <div>
                                <p class="text-md font-bold text-black">
                                    Bill To
                                </p>
                            </div>

                            <div class="sm:justify-between sm:flex">
                                 <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Name :</p>
                                    {{ $data['customer']->name }}
                                 </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Email :</p>
                                    {{  $data['customer']->email }}
                               </span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
{{--                                    @if($data['customer']->company_address)--}}
                                        <p class="text-md font-bold text-black mr-2">Address :</p>
                                        {{ $data['customer']->company_address }}
{{--                                    @endif--}}
                                 </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">GST Number :</p>
                                    {{ $data['customer']->gst_no }}
                                 </span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Phone :</p>{{ $data['customer']->phone_no}}
                                </span>
{{--                                <span class="flex items-center text-md">--}}
{{--                                    <p class="text-xl font-bold text-black ">₹ {{ number_format($data['due'],2) }}</p>--}}
{{--                                </span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto" style="padding-top: 40px">
                        <table class="w-full text-left">
                            <thead>
                            <tr>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    DESCRIPTION
                                </th>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    QUANTITY
                                </th>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    UNIT COST
                                </th>
                                <th class="text-right whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    TOTAL
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data['products']))
                            @foreach($data['products'] as $product)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->name}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->qty}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->price}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{$product->price*$product->qty}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$data['product']->name}} [ EMI {{$data['emi'] == $data['total_emis'] ? $data['emi'] : $data['emi']+1}} ]</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">1</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{number_format($data['subtotal'],2)}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{number_format($data['subtotal'],2)}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right pr-5">
                       <span class="flex items-center flex justify-end text-md">
                           <p class="text-md text-black mr-4">Subtotal :</p> {{ number_format($data['subtotal'],2) }}
                       </span>
                        <span class="flex items-center text-md flex justify-end">
                           <p class="text-md text-black mr-4">GST {{ $data['tax']? number_format($data['tax'],2): '0' }}%:</p> {{ number_format($data['due']-$data['subtotal'],2) }}
                       </span>
                        <span class="flex items-center text-md font-bold text-black justify-end">
                           <p class="text-md text-black mr-4 font-bold">Total :</p> {{ number_format($data['due'],2) }}
                       </span>
                        <button disabled class="btn px-6 py-4 text-xl mt-2 text-black font-bold"
                                style="background-color: {{($data['status']==0?'#FFD2D2':'#d2ffea')}}">
                            <span class="pr-4">{{($data['status']==0?'Due':'Paid')}}</span>
                            <span>₹ {{ number_format($data['due'],2) }}</span>
                        </button>
                    </div>
                </div>
                <div class="mt-4 rounded-lg p-4 bg-white">
                    <center><p class="text-2xl  text-black font-bold pt-5">Product Description</p></center>
                    @if(!empty($data['products']))
                    @foreach($data['products'] as $product)
                    <div>
                        <h2 class="text-2xl  text-black font-bold pt-5">{{$product->name}}</h2>
                        <div class="grid md:grid-cols-2 gap-4 mt-4 p-4">
                            <div class=" flex justify-center">
                                @if(!empty($product->product) && !empty($product->product->image))
                                <img src="{{asset('images/products/'.$product->product->image)}}" alt="{{$product->name}} Image">
                                @endif
                            </div>
                            <div class="mt-3">
                                {!! $product->product?->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div>
                        <h2 class="text-2xl  text-black font-bold pt-5">{{$data['product']->name}}</h2>
                        <div class="grid md:grid-cols-2 gap-4 mt-4 p-4">
                            <div class=" flex justify-center">
                                @if(!empty($data['product']->image))
                                <img src="{{asset('images/products/'.$data['product']->image)}}" alt="{{$data['product']->name}} Image">
                                @endif
                            </div>
                            <div class="mt-3">
                                {!! $data['product']->description !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

<script>

</script>
</body>

</html>

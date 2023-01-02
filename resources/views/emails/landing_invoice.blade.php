<!DOCTYPE html>

<html>

<head>
    <title>Invoice</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

</head>
<style type="text/css">
    img{
        object-fit: contain;
        display: flex;
        height: 15%;
        width: 100%;
        max-width: 100%;
        justify-content: center;
    }
    .card{
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
        padding-top: 5px;
        padding-bottom: 15px;
        margin-right: auto;
        margin-left: auto;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }
    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }
    @media (min-width: 1200px) {
        .container {
            width: 1170px;
        }
    }

    body{
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0{
        margin: 0px;
    }

    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }

    .mt-10{
        margin-top:10px;
    }

    .text-center{
        text-align:center !important;
    }

    .w-100{
        width: 100%;
    }

    .w-50{
        width:50%;
    }

    .w-85{
        width:85%;
    }

    .w-15{
        width:15%;
    }

    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }

    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }

    .gray-color{
        color:#5D5D5D;
    }

    .text-bold{
        font-weight: bold;
    }

    .border{
        border:1px solid black;
    }

    /*table tr,td{*/
    /*    border: 1px solid #d2d2d2;*/
    /*    border-collapse:collapse;*/
    /*    padding:7px 8px;*/
    /*}*/

    /*table th{*/
    /*    border-collapse:collapse;*/
    /*    padding:7px 8px;*/
    /*    border-collapse:collapse;*/
    /*    padding:7px 8px;*/

    /*}*/

    table tr th{
        font-size:15px;
    }

    table tr td{
        font-size:13px;
    }

    /*table{*/
    /*    border-collapse:collapse;*/
    /*}*/

    .box-text p{
        line-height:10px;
    }

    .float-left{
        float:left;
    }

    .total-part{
        font-size:16px;
        line-height:12px;
    }

    .total-right p{
        padding-right:20px;
    }

    .text-right{
        text-align: right;
    }

    .text-left{
        text-align: left;
    }

    .strong{
        font-weight: bold;
    }
</style>



<body style="background-color:  #f4f4f4">
<div class="container container-padding card">
    <div  id="element-to-print">
        <div class="head-title">
            <h1 class="text-center m-0 p-0">Paymentz.ai</h1>
{{--            <h6 class="text-center m-0 p-0">Invoice</h6><hr>--}}
        </div>
        <div class="add-detail mt-10">
            <div class="rounded-lg p-5 bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p>
                            Due Amount
                        </p>
                        <p class="text-3xl text-black font-bold">
                            {{--                            ₹ {{number_format($data['due'],2)}}--}}
                        </p>
                    </div>
                    {{--                    @if($invoiceData['status']==0)--}}
                    {{--                        <a href="{{route('invoices.payment.page',['id'=>$id,'invoiceId'=>$invoiceId,'rinvoiceId'=>$rinvoiceId,'amount'=>$data['due']])}}" class="btn bg-green-400 font-medium text-white py-2 px-5 rounded-lg text-md">--}}
                    {{--                            Pay Now--}}
                    {{--                        </a>--}}
                    {{--                    @else--}}
                    {{--                        <span class="text-success">Paid</span>--}}
                    {{--                    @endif--}}
                </div>
            </div>
            <div class="mt-4 rounded-lg  bg-white" style="padding-bottom: 150px">
                <h3 class="text-center m-0 p-0">Invoice</h3><hr>
                <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;padding-top: 50px">
                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                        <tr>
                            <td style="color: #5b5b5b;  line-height: 18px; vertical-align: top; text-align: left;">
                                <div class="px-5">
                                    <div class="justify-between flex">
                                        <p class="text-md font-bold text-black">
                                            Member
                                        </p>
                                        <p class="text-md font-bold text-black">
                                            Invoice No:
                                            {{$invoiceData['invoice_number']}}
                                        </p>
                                        {{--                            <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">--}}
                                        {{--                            <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">--}}
                                    </div>

                                    <div class="justify-between flex">
                                        <p class="text-md font-bold text-black">
                                            Name of Company:
                                            {{$userdetails?->business_name}}
                                        </p>

                                        <p class="text-md font-bold text-black">
                                            Email: {{$user?->email}}
                                        </p>
                                        {{--                                <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">--}}
                                        {{--                                <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">--}}
                                    </div>

                                    <div class="sm:justify-between sm:flex">
                                            <span class="flex items-center text-md">
                                                <p class="text-md font-bold text-black mr-2">Phone : {{$user?->phone_no}}</p>
                                            </span>
                                        <span class="flex items-center text-md">
                                            <p class="text-md font-bold text-black mr-2">Address :  {{ isset($userdetails?->business_address) ? $userdetails?->business_address . ', ' . $userdetails?->business_city . ', ' . $userdetails?->business_state . ', ' . $userdetails?->business_country : ''}}</p>
                                        </span>
                                    </div>
                                    <div class="sm:justify-between sm:flex">
                                        <span class="flex items-center text-md">
                                            <p class="text-md font-bold text-black mr-2">GST Number : {{  $userdetails?->business_gst_no }}</p>
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;">
                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                        <tr>
                            <td style="color: #5b5b5b; line-height: 1; vertical-align: top; text-align: right;">
                                <div class="px-5">
                                    <div>
                                        <p class="text-md font-bold text-black">
                                            Bill To
                                        </p>
                                    </div>

                                    <div class="justify-between flex">
                                             <span class="flex items-center text-md">
                                                <p class="text-md font-bold text-black mr-2">Name : {{ $customer?->name }}</p>
                                             </span>
                                        <span class="flex items-center text-md">
                                                <p class="text-md font-bold text-black mr-2">Email :{{  $customer?->email }}</p>
                                           </span>
                                    </div>
                                    <div class="justify-between flex">
                                            <span class="flex items-center text-md">
                                                    <p class="text-md font-bold text-black mr-2">Address : {{ $customer?->company_address }}</p>
                                                {{--                                    @endif--}}
                                             </span>
                                        <span class="flex items-center text-md">
                                                <p class="text-md font-bold text-black mr-2">GST Number :{{ $customer?->gst_no }}</p>
                                             </span>
                                    </div>
                                    <div class="justify-between flex">
                                            <span class="flex items-center text-md">
                                                <p class="text-md font-bold text-black mr-2">Phone :{{ $customer?->phone_no}}</p>
                                            </span>
                                        {{--                                <span class="flex items-center text-md">--}}
                                        {{--                                    <p class="text-xl font-bold text-black ">₹ {{ number_format($data['due'],2) }}</p>--}}
                                        {{--                                </span>--}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto" style="padding-top: 40px">
                    <table class="w-full text-left"  border="1">
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
{{--                        @dd($products)--}}
                            @if(!empty($products))
                                @foreach($products as $product)
                                    {{--                                @dd($product?->name)--}}
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product?->name}}</td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product?->qty}}</td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product?->price}}</td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{$product?->price * $product?->qty}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$products?->name}} </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">1</td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{number_format($subtotal,2)}}</td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{number_format($subtotal,2)}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="float-right pr-5">
                   <span class="flex items-center flex justify-end text-md">
                       <p class="text-md text-black mr-4">Subtotal : {{ number_format($subtotal,2) }}</p>
                   </span>
                    <span class="flex items-center text-md flex justify-end">
                           <p class="text-md text-black mr-4">GST {{ $tax? number_format($due,2): '0' }}%: {{ number_format($due-$subtotal,2) }}</p>
                       </span>
                    <span class="flex items-center text-md font-bold text-black justify-end">
                           <p class="text-md text-black mr-4 font-bold">Total : {{ number_format($due,2) }}</p>
                       </span>
{{--                    <button disabled class="btn px-6 py-4 text-xl mt-2 text-black font-bold"--}}
{{--                            style="background-color: {{($data['status']==0?'#FFD2D2':'#d2ffea')}}">--}}
{{--                        <span class="pr-4">{{($data['status']==0?'Due':'Paid')}}</span>--}}
{{--                        <span>₹ {{ number_format($data['due'],2) }}</span>--}}
{{--                    </button>--}}
                        <span class="btn px-6 py-4 text-xl mt-2 text-black font-bold">DUE: ₹ {{ number_format($due,2) }}</span>

                </div>
                <div class="mt-4 rounded-lg p-4 bg-white">
                    <center><p class="text-2xl font-bold pt-5">Product Description</p></center>
                    @if(!empty($products))
                        @foreach($products as $product)
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
                                <h2 class="text-2xl  text-black font-bold pt-5">{{$products->name}}</h2>
                                <div class="grid md:grid-cols-2 gap-4 mt-4 p-4">
                                    <div class=" flex justify-center">
                                        @if(!empty($products->image))
                                            <img src="{{asset('images/products/'.$products->image)}}" alt="{{$products->name}} Image">
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        {!! $products->description !!}
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>

                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

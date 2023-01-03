@extends('layouts.app')

@section('heading', 'My Business')

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
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{route('subscriptions.index')}}"
            >Subscription</a
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
        <li>User Details</li>
    </ul>
@endsection

@section('content')

    <!-- Users Table -->
    <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
        <div
            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200 mb-4"
        >
            <div class="tabs-list flex px-1.5 py-1">
                <button
                    @click="activeTab = 'tabHome'"
                    onclick="saveSelectedTab('user_details')"
                    id="user_detailsTab"
                    :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    User Details
                </button>
                <button
                    @click="activeTab = 'tabInvoice'"
                    onclick="saveSelectedTab('invoice')"
                    id="invoiceTab"
                    :class="activeTab === 'tabInvoice' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Invoice
                </button>
                <button
                    @click="activeTab = 'tabSubscription'"
                    onclick="saveSelectedTab('subscription')"
                    id="subscriptionTab"
                    :class="activeTab === 'tabSubscription' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Subscription
                </button>
            </div>
        </div>
        <div class="tab-content pt-4">
            <div
                x-show="activeTab === 'tabHome'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                                <!-- User Details -->
                        <div class="col-span-12 grid lg:col-span-12">
                            <div class="card">
                                    <div class="space-y-4 p-4 sm:p-5">

                                        <div id="profilepicdiv">
                                            <img style="height: 200px!important; width: 200px" src="{{asset(auth()->user()?->profile?'/images/users/'.auth()->user()?->profile:'images/200x200.png')}}">
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <label class="block">
                                                <span>Name</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    value="{{ $customer_data->name }}"
                                                    readonly
                                                />
                                            </label>
                                            @if($customer_data->company_name)
                                                <label class="block">
                                                    <span>Company Name</span>
                                                    <input
                                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        value="{{ $customer_data->company_name }}"
                                                        readonly
                                                    />
                                                </label>
                                            @endif
                                        </div>
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <label class="block">
                                                <span>Email</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    readonly
                                                    value="{{ $customer_data->email }}"
                                                />
                                            </label>

                                            <label class="block">
                                                <span>Phone</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    value="{{ $customer_data->phone_no }}"
                                                    readonly
                                                />
                                            </label>
                                        </div>
                                        @if($customer_data->business_address)
                                            <label class="block">
                                                <span>Business Address</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    value="{{ $customer_data->business_address }}"
                                                    readonly
                                                />
                                            </label>
                                        @endif
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">

                                            <label class="block sm:col-span-5">
                                                <span>Your State</span>
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    value="{{  $customer_data->state }}"
                                                    readonly
                                                />
                                            </label>
                                            @if($customer_data->gst_no)
                                                <label class="block sm:col-span-7">
                                                    <span>Business GST Number</span>
                                                    <input
                                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        value="{{ $customer_data->gst_no }}"
                                                        readonly
                                                    />
                                                </label>
                                            @endif
                                        </div>
                                    </div>
{{--                                </form>--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div
            x-show="activeTab === 'tabInvoice'"
            x-transition:enter="transition-all duration-500 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
        >
                <div>
                    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                        <!-- Invoice Details -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Invoice Details
                                </h2>
                                <div class="flex">
                                    <div class="flex items-center" x-data="{isInputActive:false}">
                                        <label class="block">
                                            <span class="relative mr-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Search here..."
                                                    onchange="tableSearch(this)"
                                                    name="search"
                                                    type="text"
                                                    value="{{request('search','')}}"
                                                />
                                            </span>
                                        </label>
                                    </div>
                                    {{--                                    <div--}}
                                    {{--                                        class="inline-flex"--}}
                                    {{--                                    >--}}
                                    {{--                                        <a href="{{route('incomes.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Income/Expense</a>--}}
                                    {{--                                    </div>--}}
                                </div>
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
                                                Invoice Number
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Customer Name
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Total Amount
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                GST Number
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Payment Method
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Status
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($invoices as $invoice)
                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->invoice_number }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $invoice->customer->name }}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $invoice->total_amount}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ isset($invoice->customer->gst_no) ? $invoice->customer->gst_no : '-' }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >
                                                    @if($invoice->payment_method==0)
                                                        Offline
                                                    @elseif($invoice->payment_method==1)
                                                        Credit Card
                                                    @elseif($invoice->payment_method==2)
                                                        Debit Card
                                                    @elseif($invoice->payment_method==3)
                                                        Gateway ({{$invoice->payments?->last()?->gateway}})
                                                    @else
                                                        Unknown
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >
                                                    @if($invoice->status==0)
                                                        Pending
                                                    @elseif($invoice->status==1)
                                                        Paid
                                                    @elseif($invoice->status==2)
                                                        Pending
                                                    @else
                                                        Unknown
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="5" class="text-center">No record found</td>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                                >
                                    {{$invoices->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div
                x-show="activeTab === 'tabSubscription'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                        <!-- Subscription Table -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Subscription Invoices
                                </h2>
                                <div class="flex">
                                    <div class="flex items-center" x-data="{isInputActive:false}">
                                        <label class="block">
                                            <span class="relative mr-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Search here..."
                                                    onchange="tableSearch(this)"
                                                    name="search"
                                                    type="text"
                                                    value="{{request('search','')}}"
                                                />
                                            </span>
                                        </label>
                                    </div>
                                    {{--                                    <div--}}
                                    {{--                                        class="inline-flex"--}}
                                    {{--                                    >--}}
                                    {{--                                        <a href="{{route('incomes.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Income/Expense</a>--}}
                                    {{--                                    </div>--}}
                                </div>
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
                                                Invoice Number
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Customer Name
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Downpayment
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Product Cost
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Pending Amount
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                No of Emi’s Approved
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Monthly EMI
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Next EMI Date
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                No of Paid EMI’s
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                No of Due EMI's
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Subscription Status
                                            </th>
                                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($rinvoices as $rinvoice)
                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $rinvoice->invoices->last()?->invoice_number }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $rinvoice->customer?->name }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >₹ {{ $rinvoice->downpayment}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >₹ {{ $rinvoice->product->price}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >₹ {{ $rinvoice->pending}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >₹ {{ $rinvoice->total_emis }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >₹ {{ $rinvoice->emi_amount}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $rinvoice->next_emi_date->format('d-m-Y') }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $rinvoice->paid_emis}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ ($rinvoice->total_emis - $rinvoice->paid_emis)}} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" >
                                                    @if($rinvoice->status==0)
                                                        @if($rinvoice->next_emi_date->isPast())
                                                            Overdue
                                                        @else
                                                            Pending
                                                        @endif
                                                    @elseif($rinvoice->status==1)
                                                        Paid
                                                    @else
                                                        Unknown
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <a href="{{route('invoices.payment',['id'=>auth()->id(),'invoiceId'=>0,'rinvoiceId'=>$rinvoice->id])}}" target="_blank" title="Share next emi invoice now"><i class="fa-solid fa-share-from-square"></i></a>
                                                </td>
                                                @empty
                                                    <td colspan="12" class="text-center">No record found</td>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                                >
                                    {{$rinvoices->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                function incomeDelete(obj)
                {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Warning!',
                                'Deleting Data',
                                'warning'
                            );
                            $(obj).closest('form').submit();
                        }
                    })
                }
                function tableSearch(obj)
                {
                    $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
                }
                function saveSelectedTab(name)
                {
                    setCookie('business_stat',name,7);
                }
                $(document).ready(function(){
                    name = getCookie('business_stat');
                    if(name!='')
                        $('#'+name+'Tab').click();
                })
            </script>

    @endpush

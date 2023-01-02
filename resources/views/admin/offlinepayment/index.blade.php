@extends('layouts.app')

@section('heading', 'Invoices')
@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{ route('admin.dashboard') }}"
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
        <li>Offline Payment</li>
    </ul>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <!-- Customer Table -->
        <div>
            <div class="flex items-center justify-between">
                <h2
                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                >
                    Invoice Table
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
                    <div
                        class="inline-flex"
                    >
                        <a href="{{route('invoices.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Invoice</a>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
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
                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                             <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->invoice_number }} </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->customer->name }} </td>
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

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div
                                            x-data="usePopper({placement:'bottom-end',offset:4})"
                                            @click.outside="if(isShowPopper) isShowPopper = false"
                                            class="inline-flex"
                                        >
                                        <a href="{{route('invoices.payment',['id'=>auth()->id(),'invoiceId'=>$invoice->id,'rinvoiceId'=>0])}}" target="_blank" title="Share invoice now"><i class="fa-solid fa-share-from-square"></i></a>
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
                                                <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                                    <ul>
                                                        <li>
                                                            <a
                                                                href="{{ route('invoices.pdf', $invoice->id) }}"
                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                PDF
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        @empty
                            <td colspan="5" class="text-center">No record found</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                    {{$invoices->links()}}
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            function tableSearch(obj)
            {
                $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
            }

        </script>
    @endpush

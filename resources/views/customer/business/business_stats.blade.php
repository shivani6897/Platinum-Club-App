@extends('layouts.app')

@section('heading', 'Business Stats')
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
      href="{{url('business')}}"
      >My Business</a
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
  <li>Business Stats</li>
</ul>
@endsection
@section('content')
    <div class="col-span-12 lg:col-span-8">
    <div
      class="grid grid-cols-2 gap-4 sm:grid-cols-4 sm:gap-5 lg:gap-6"
    >
      <div class="card col-span-2">
        <div
          class="mt-3 flex items-center justify-between px-4 sm:px-5"
        >
          <h2
            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
          >
            Revenue Earned
          </h2>
          <div
            x-data="usePopper({placement:'bottom-end',offset:4})"
            @click.outside="if(isShowPopper) isShowPopper = false"
            class="inline-flex"
          >
          </div>
        </div>
        <div class="pr-3 sm:pl-2">
          <div id="revenueChart"></div>
        </div>
      </div>
      <div class="card col-span-2">
        <div
          class="mt-3 flex items-center justify-between px-4 sm:px-5"
        >
          <h2
            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
          >
            Ad Spends
          </h2>
          <div
            x-data="usePopper({placement:'bottom-end',offset:4})"
            @click.outside="if(isShowPopper) isShowPopper = false"
            class="inline-flex"
          >
          </div>
        </div>
        <div class="pr-3 sm:pl-2">
          <div id="adSpendChart"></div>
        </div>
      </div>
      <div class="card col-span-2">
        <div
          class="mt-3 flex items-center justify-between px-4 sm:px-5"
        >
          <h2
            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
          >
            Overheads
          </h2>
          <div
            x-data="usePopper({placement:'bottom-end',offset:4})"
            @click.outside="if(isShowPopper) isShowPopper = false"
            class="inline-flex"
          >
          </div>
        </div>
        <div class="pr-3 sm:pl-2">
          <div id="overheadsChart"></div>
        </div>
      </div>
      <div class="card col-span-2">
        <div
          class="mt-3 flex items-center justify-between px-4 sm:px-5"
        >
          <h2
            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
          >
            Net Profit
          </h2>
          <div
            x-data="usePopper({placement:'bottom-end',offset:4})"
            @click.outside="if(isShowPopper) isShowPopper = false"
            class="inline-flex"
          >
          </div>
        </div>
        <div class="pr-3 sm:pl-2">
          <div id="netProfitChart"></div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
  @include('customer.business.chartJs')
@endpush

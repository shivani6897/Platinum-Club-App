@extends('layouts.app')

@push('styles')
    <style type="text/css">
        .required:after{
            content:'*';
            color:red;
            padding-left:5px;
        }
    </style>
@endpush

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
                href="{{route('incomes.index')}}"
            >Business</a
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
        <li>Add Business</li>
    </ul>
@endsection

@section('content')
    {{--<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">--}}
    {{--  <div class="col-span-12">--}}
    {{--    <div class=" p-4 sm:p-5">--}}
    {{--      <p--}}
    {{--        class="text-base font-medium text-slate-700 dark:text-navy-100"--}}
    {{--      >--}}
    {{--        @isset($businessStat) Edit @else Add @endisset Stats--}}
    {{--      </p>--}}

    {{--      @isset($businessStat)--}}
    {{--        {!! Form::model($businessStat, ['route' => ['business.update', $businessStat->id], 'method' => 'patch', 'autocomplete' => 'off']) !!}--}}
    {{--      @else--}}
    {{--        {!! Form::open(['route' => ['business.store'], 'method' => 'POST', 'autocomplete' => 'off']) !!}--}}
    {{--      @endisset--}}
    {{--        @csrf--}}
    {{--        <div class="mt-4 space-y-4">--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Month</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                    x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'F Y',dateFormat: 'F Y',viewMode: 'years'})"--}}
    {{--                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent--}}
    {{--                    float_value"--}}
    {{--                    placeholder="Month"--}}
    {{--                    name="month"--}}
    {{--                    type="text"--}}
    {{--                    value="{{(isset($businessStat) ? $businessStat->month : '')}}"--}}
    {{--                    required--}}
    {{--                  />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Total Revenue Earned (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Total Revenue Earned"--}}
    {{--                  name="revenue_earned"--}}
    {{--                  type="text"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->revenue_earned : '')}}"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Total Ad Spends (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Total Ad Spends"--}}
    {{--                  name="ad_spends"--}}
    {{--                  type="text"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->ad_spends : '')}}"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Average Cost Per Lead (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Average Cost Per Lead"--}}
    {{--                  name="avg_cost_per_lead"--}}
    {{--                  type="text"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->avg_cost_per_lead : '')}}"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Total Leads Generated</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Total Leads Generated"--}}
    {{--                  name="leads_generated"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->leads_generated : '')}}"--}}
    {{--                  type="text"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Total Paid Customers (L1)</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Total Paid Customers (L1)"--}}
    {{--                  name="paid_customer"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->paid_customer : '')}}"--}}
    {{--                  type="text"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Total Group Size</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Total Group Size"--}}
    {{--                  name="group_size"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->group_size : '')}}"--}}
    {{--                  type="text"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}
    {{--          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
    {{--            <label class="block">--}}
    {{--              <span class="required">Ovderhead</span>--}}
    {{--              <span class="relative mt-1.5 flex">--}}
    {{--                <input--}}
    {{--                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent --}}
    {{--                  float_value"--}}
    {{--                  placeholder="Return On Ad Spends"--}}
    {{--                  name="overheads"--}}
    {{--                  type="text"--}}
    {{--                  value="{{(isset($businessStat) ? $businessStat->overheads : '')}}"--}}
    {{--                  required--}}
    {{--                />--}}
    {{--              </span>--}}
    {{--            </label>--}}
    {{--          </div>--}}

    {{--          <div class="flex justify-end space-x-2">--}}
    {{--            <a--}}
    {{--              class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"--}}
    {{--              href="{{url('business')}}"--}}
    {{--            >--}}
    {{--              Cancel--}}
    {{--            </a>--}}
    {{--            <button--}}
    {{--              class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"--}}
    {{--              type="submit"--}}
    {{--            >--}}
    {{--              <span>Submit</span>--}}
    {{--            </button>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--      {{Form::close()}}--}}
    {{--    </div>--}}
    {{--  </div>--}}
    {{--</div>--}}


    <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
        <div
            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
        >
            <div class="tabs-list flex px-1.5 py-1">
                <button
                    @click="activeTab = 'tabHome'"
                    onclick="saveSelectedTab('income')"
                    id="incomeTab"
                    :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Income
                </button>
                <button
                    @click="activeTab = 'tabProfile'"
                    onclick="saveSelectedTab('expense')"
                    id="expenseTab"
                    :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Expense
                </button>
                <button
                    @click="activeTab = 'tabMessages'"
                    onclick="saveSelectedTab('lead')"
                    id="leadTab"
                    :class="activeTab === 'tabMessages' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Lead
                </button>
{{--                <button--}}
{{--                    @click="activeTab = 'tabSettings'"--}}
{{--                    :class="activeTab === 'tabSettings' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"--}}
{{--                    class="btn shrink-0 px-3 py-1.5 font-medium"--}}
{{--                >--}}
{{--                    Converted Customers--}}
{{--                </button>--}}
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
                    <form method="POST"
                          action="{{ route('incomes.store') }}"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Income Category</span>
                                                <select
                                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                                    @error('income_category_id')
                                                        border-error
                                                    @enderror"
                                                    name="income_category_id"
                                                    required
                                                >
                                                    @foreach($incomeCateogries as $incomeCateogry)
                                                        <option value="{{$incomeCateogry->id}}" @selected(old('income_cateogry_id',0)==$incomeCateogry->id)>{{$incomeCateogry->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('club_id')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
{{--                                        </div>--}}

{{--                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
                                            <label class="block">
                                                <span>Income</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                             @error('income')
                                                                  border-error
                                                             @enderror"
                                                        placeholder="income"
                                                        name="income"
                                                        type="number"
                                                        value="{{old('income')}}"
                                                        required
                                                        autocomplete="off"
                                                      />
                                                </span>
                                                @error('income')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
                                            <label class="block">
                                                  <span class="required">Date</span>
                                                  <span class="relative flex">
                                                      <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="{{ old('date') }}"
                                                        required
                                                        autocomplete="off"
                                                      />
                                              </span>
                                            </label>
                                        </div>
                                        <label class="block">
                                            <span>Description</span>
                                            <textarea
                                                rows="4"
                                                placeholder="Description"
                                                autocomplete="off"
                                                name="description"
                                                autocomplete="off"
                                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                {{ old('description') }}
                                            </textarea>
                                            @error('description')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                            @enderror
                                        </label>

                                    <div class="flex justify-end space-x-2">
                                        <button
                                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                            type="submit"
                                        >
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>

            <div
                x-show="activeTab === 'tabProfile'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <form method="POST"
                          action="{{ route('expenses.store') }}"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Expense Category</span>
                                                <select
                                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                                    @error('expense_category_id')
                                                        border-error
                                                    @enderror"
                                                    name="expense_category_id"
                                                    required
                                                >
                                                    @foreach($expenseCateogries as $expenseCateogry)
                                                        <option value="{{$expenseCateogry->id}}" @selected(old('expense_category_id',0)==$expenseCateogry->id)>{{$expenseCateogry->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('club_id')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
{{--                                        </div>--}}

{{--                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
                                            <label class="block">
                                                <span>Expense</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                         @error('expense')
                                                            border-error
                                                         @enderror"
                                                         placeholder="expense"
                                                         name="expense"
                                                         type="number"
                                                         value="{{old('expense')}}"
                                                         required
                                                         autocomplete="off"
                                                    />
                                                </span>
                                                @error('expense')
                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
                                            <label class="block">
                                                <span class="required">Date</span>
                                                <span class="relative flex">
                                                    <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="{{ old('date') }}"
                                                        required
                                                        autocomplete="off"
                                                    />
                                                </span>
                                            </label>
                                        </div>
                                        <label class="block">
                                            <span>Description</span>
                                            <textarea
                                                rows="4"
                                                placeholder="Description"
                                                autocomplete="off"
                                                name="description"
                                                autocomplete="off"
                                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                {{ old('description') }}
                                            </textarea>
                                            @error('description')
                                            <span class="text-tiny+ text-error">{{$message}}</span>
                                            @enderror
                                        </label>

                                        <div class="flex justify-end space-x-2">
                                            <button
                                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                                type="submit"
                                            >
                                                <span>Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div
                x-show="activeTab === 'tabMessages'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <form method="POST"
                          action="{{ route('leads.store') }}"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Generated Lead</span> <span>*</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="Lead Generated"
                                                        type="number"
                                                        name="lead_generated"
                                                        autocomplete="off"
                                                        value="{{ old('lead_generated') }}"
                                                        required
                                                    />
                                                </span>
                                                @error('lead_generated')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
                                            <label class="block">
                                                <span>Converted Customer</span> <span>*</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="Converted Customer"
                                                        type="number"
                                                        name="converted_customer"
                                                        autocomplete="off"
                                                        value="{{ old('converted_customer') }}"
                                                        required
                                                    />
                                                </span>
                                                @error('converted_customer')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                                @enderror
                                            </label>
                                            <label class="block">
                                                <span class="required">Date</span>
                                                <span class="relative flex">
                                                    <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="{{ old('date') }}"
                                                        required
                                                        autocomplete="off"
                                                    />
                                                </span>
                                            </label>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button
                                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                            >
                                                <span>Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
{{--            <div--}}
{{--                x-show="activeTab === 'tabSettings'"--}}
{{--                x-transition:enter="transition-all duration-500 easy-in-out"--}}
{{--                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"--}}
{{--                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"--}}
{{--            >--}}
{{--                <div>--}}
{{--                    <form method="POST"--}}
{{--                          action="{{ route('admin.habits.store') }}"--}}
{{--                          accept-charset="UTF-8"--}}
{{--                          class="p-lg-5 p-3"--}}
{{--                          enctype="multipart/form-data"--}}
{{--                    >--}}
{{--                        @csrf--}}

{{--                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">--}}
{{--                            <div class="col-span-12">--}}
{{--                                <div class="card p-4 sm:p-5">--}}
{{--                                    <div class="mt-4 space-y-4">--}}
{{--                                        <label class="block">--}}
{{--                                            <span>Name</span> <span>*</span>--}}
{{--                                            <span class="relative mt-1.5 flex">--}}
{{--                                                <input--}}
{{--                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"--}}
{{--                                                    placeholder="Habit"--}}
{{--                                                    type="text"--}}
{{--                                                    name="name"--}}
{{--                                                    autocomplete="off"--}}
{{--                                                    value="{{ old('name') }}"--}}
{{--                                                    required--}}
{{--                                                />--}}
{{--                                            </span>--}}
{{--                                            @error('name')--}}
{{--                                            <span class="text-tiny+ text-error">{{$message}}</span>--}}
{{--                                            @enderror--}}
{{--                                        </label>--}}
{{--                                        <div class="flex justify-end space-x-2">--}}
{{--                                            <button--}}
{{--                                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"--}}
{{--                                            >--}}
{{--                                                <span>Submit</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.float_value').keyup(function () {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
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

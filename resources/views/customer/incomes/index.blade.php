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

        </li>
        <li>My Business</li>
    </ul>
@endsection

@section('content')

    <!-- Users Table -->
    <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
        <div
            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
        >
            <div class="tabs-list flex px-1.5 py-1">
                <button
                    @click="activeTab = 'tabHome'"
                    :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Income
                </button>
                <button
                    @click="activeTab = 'tabProfile'"
                    :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Expense
                </button>
                <button
                    @click="activeTab = 'tabMessages'"
                    :class="activeTab === 'tabMessages' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Lead
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
                                <!-- Income Table -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Income Table
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
                                        <a href="{{route('incomes.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Income/Expense</a>
                                    </div>
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
                                            {{--                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">--}}
                                            {{--                                                Income cattegory--}}
                                            {{--                                            </th>--}}
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Income
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Dates
                                            </th>
                                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($income as $single_income)
                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_income->income }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $single_income->date ? ($single_income->date?->format('d-m-Y')) : '' }} </td>

                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <div
                                                        x-data="usePopper({placement:'bottom-end',offset:4})"
                                                        @click.outside="if(isShowPopper) isShowPopper = false"
                                                        class="inline-flex"
                                                    >
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
                                                                            href="{{ route('incomes.edit', $single_income->id) }}"
                                                                            class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            class="d-inline"
                                                                            action="{{ route('incomes.destroy',$single_income->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <button
                                                                                type="button"
                                                                                onclick="incomeDelete(this)"
                                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                                            >Delete
                                                                            </button>
                                                                        </form>
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
                                <div
                                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                                >
                                    {{$income->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content pt-4">
            <div
            x-show="activeTab === 'tabProfile'"
            x-transition:enter="transition-all duration-500 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
        >
            <div>
                <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                    <!-- Expense Table -->
                    <div>
                        <div class="flex items-center justify-between">
                            <h2
                                class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                            >
                                Expense Table
                            </h2>
{{--                            <div class="flex">--}}
{{--                                <div class="flex items-center" x-data="{isInputActive:false}">--}}
{{--                                    <label class="block">--}}
{{--                                <span class="relative mr-1.5 flex">--}}
{{--                                  <input--}}
{{--                                      class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"--}}
{{--                                      placeholder="Search here..."--}}
{{--                                      onchange="tableSearch(this)"--}}
{{--                                      name="search"--}}
{{--                                      type="text"--}}
{{--                                      value="{{request('search','')}}"--}}
{{--                                  />--}}
{{--                                </span>--}}
{{--                                    </label>--}}
{{--                                    <button--}}
{{--                                        @click="isInputActive = !isInputActive"--}}
{{--                                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"--}}
{{--                                    >--}}
{{--                                        <svg--}}
{{--                                            xmlns="http://www.w3.org/2000/svg"--}}
{{--                                            class="h-4.5 w-4.5"--}}
{{--                                            fill="none"--}}
{{--                                            viewBox="0 0 24 24"--}}
{{--                                            stroke="currentColor"--}}
{{--                                        >--}}
{{--                                            <path--}}
{{--                                                stroke-linecap="round"--}}
{{--                                                stroke-linejoin="round"--}}
{{--                                                stroke-width="1.5"--}}
{{--                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"--}}
{{--                                            />--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    class="inline-flex"--}}
{{--                                >--}}
{{--                                    <a href="{{route('expenses.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Expense</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
                                            Expense
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Date
                                        </th>
                                        <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($expense as $key=>$single_expense)
                                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_expense->expense }} </td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $single_expense->date ? ($single_expense->date?->format('d-m-Y')) : '' }} </td>

                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div
                                                    x-data="usePopper({placement:'bottom-end',offset:4})"
                                                    @click.outside="if(isShowPopper) isShowPopper = false"
                                                    class="inline-flex"
                                                >
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
                                                                        href="{{ route('expenses.edit', $single_expense->id) }}"
                                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        class="d-inline"
                                                                        action="{{ route('expenses.destroy',$single_expense->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <button
                                                                            type="button"
                                                                            onclick="incomeDelete(this)"
                                                                            class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                                        >Delete
                                                                        </button>
                                                                    </form>
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
                            <div
                                class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                            >
                                {{$expense->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="tab-content pt-4">
            <div
                x-show="activeTab === 'tabMessages'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                        <!-- Lead Table -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Lead Table
                                </h2>
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
                                                Lead
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Converted Customers
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Date
                                            </th>
                                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($lead as $single_lead)
                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_lead->lead_generated }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_lead->converted_customer }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $single_lead->date ? ($single_lead->date?->format('d-m-Y')) : '' }} </td>

                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <div
                                                        x-data="usePopper({placement:'bottom-end',offset:4})"
                                                        @click.outside="if(isShowPopper) isShowPopper = false"
                                                        class="inline-flex"
                                                    >
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
                                                                            href="{{ route('leads.edit', $single_lead->id) }}"
                                                                            class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            class="d-inline"
                                                                            action="{{ route('leads.destroy',$single_lead->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <button
                                                                                type="button"
                                                                                onclick="incomeDelete(this)"
                                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                                                            >Delete</button>
                                                                        </form>
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
                                <div
                                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
                                >
                                    {{$income->links()}}
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
            </script>
            <script>
                function tableSearch(obj)
                {
                    $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
                }
            </script>

    @endpush

@extends('admin.layouts.app')

@section('heading', 'Events')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="#"
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
                href="#"
            >Events</a
            >
        </li>
    </ul>
@endsection
@section('content')
    <div class="table-wrapper">
        <div class="card light bordered card-no-padding m-3 p-3 m-sm-5 p-sm-5">
            <div class="card-body">
                <div class="table-responsive  table-has-actions   table-has-filter ">
                    <div class="justify-content-between dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div>
                            <span class="flex justify-end ">
                                <a
                                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    data-action="create"
                                    href="{{ route('admin.events.create') }}">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </span>
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex">
                                    <div class="flex items-center" x-data="{isInputActive:false}">
                                            <label class="block">
                                                <input
                                                    x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
                                                    :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
                                                    class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                                                    placeholder="Search here..."
                                                    type="text"
                                                    name="search"
                                                />
                                            </label>
                                            <button
                                                @click="isInputActive = !isInputActive"
                                                class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4.5 w-4.5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                                    />
                                                </svg>
                                            </button>
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
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Name
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                              Links
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Event Dates
                                            </th>
                                            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($event as $key=>$single_event)
                                             <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">{{$single_event->id}}</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_event->name }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $single_event->link }} </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $single_event->event_date_time ? ($single_event->event_date_time?->format('d/m/Y H:m')) : '' }} </td>

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
                                                                                href="{{ route('admin.events.edit', $single_event->id) }}"
                                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                                Edit
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form
                                                                                class="d-inline"
                                                                                action="{{ route('admin.events.destroy',$single_event->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input name="_method" type="hidden" value="DELETE">
                                                                                <button class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Delete</button>
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
                                    {{$event->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

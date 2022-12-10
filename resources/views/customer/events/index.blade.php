@extends('layouts.app')

@section('heading', 'Events')

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
        <li>Events</li>
    </ul>
@endsection

@section('content')
{{--    <div class="flex items-center justify-end py-5 lg:py-6">--}}
{{--        <div class="flex items-center space-x-2">--}}
{{--            <label class="relative hidden sm:flex">--}}
{{--                <input--}}
{{--                    class="form-input peer h-9 w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"--}}
{{--                    placeholder="Search event..."--}}
{{--                    type="text"--}}
{{--                />--}}
{{--                <span--}}
{{--                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"--}}
{{--                >--}}
{{--                <svg--}}
{{--                    xmlns="http://www.w3.org/2000/svg"--}}
{{--                    class="h-4 w-4 transition-colors duration-200"--}}
{{--                    fill="currentColor"--}}
{{--                    viewBox="0 0 24 24"--}}
{{--                >--}}
{{--                  <path--}}
{{--                      d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z"--}}
{{--                  />--}}
{{--                </svg>--}}
{{--              </span>--}}
{{--            </label>--}}

{{--        </div>--}}
{{--    </div>--}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4 my-5">
        @forelse($event as $key=>$events)
            <div class="card">
                <div class="card-body">
                    <div class="p-2 py-4" style="border-radius: 5px;font-size: 18px;
                        text-transform: uppercase;text-align: center;font-weight: 500;letter-spacing: .05em;background: #f4f3f9;">
                        {{ $events->name }} {{ $events->event_date_time ? '- ' . ($events->event_date_time?->format('d/m/Y')) : ''}}</div>
                </div>
                <div class="py-4 flex grow flex-col items-center px-4 pb-5 sm:px-5">
{{--                    <div class="avatar h-20 w-20">--}}
{{--                        <img--}}
{{--                            class="rounded-full"--}}
{{--                            src="images/200x200.png"--}}
{{--                            alt="avatar"--}}
{{--                        />--}}
{{--                    </div>--}}
                    <div class="my-1 h-px bg-slate-200 dark:bg-navy-500" style="width: 100%;"></div>

                    <h4
                        class="pt-3 pb-3 text-md text-slate-700 dark:text-navy-100"
                    >
                        <span class="font-medium">Date</span> : {{ $events->event_date_time ? ($events->event_date_time?->format('d M Y')) : ''}}
                    </h4>
                    <div class="my-1 h-px bg-slate-200 dark:bg-navy-500" style="width: 100%;"></div>

                    <h5
                        class="pt-3 pb-3 text-md text-slate-700 dark:text-navy-100"
                    >
                        <span class="font-medium">Time</span> : {{ $events->event_date_time ? ($events->event_date_time?->format('h:m a')) : ''}}
                    </h5>
                    <div class="my-1 h-px bg-slate-200 dark:bg-navy-500" style="width: 100%;"></div>

                    {{--                    <div class="inline-space mt-3 flex grow flex-wrap items-start">--}}
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="tag rounded-full bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"--}}
{{--                        >--}}
{{--                            PHP--}}
{{--                        </a>--}}
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="tag rounded-full bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"--}}
{{--                        >--}}
{{--                            Nodejs--}}
{{--                        </a>--}}
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="tag rounded-full bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"--}}
{{--                        >--}}
{{--                            ReactJS--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    @if(isset( $events->link))
                        <div class="mt-6 grid w-full grid-cols-1 gap-2">
                            <a href="{{ $events->link }}"
                               target="_blank"
                                class="btn space-x-2 px-0 font-medium text-white" style="background-color: #e84c37;"
                            >
                                <span>Join Event</span>
                            </a>
                        </div>
                        @endif
                </div>
            </div>
        @empty
            <h6 class="text-center w-100 py-3 m-2" style="font-size: 1.75rem; border-radius: 10px; background-color: #e1e1e1"> No events available.</h6>
        @endforelse
    </div>
</main>
@endsection

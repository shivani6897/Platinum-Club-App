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
        <li>Edit</li>
    </ul>
@endsection

@section('content')
    <form method="POST"
          action="{{ route('admin.events.update',$event->id) }}"
          accept-charset="UTF-8"
          class="p-lg-5 p-3"
          enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12">
                <div class="card p-4 sm:p-5">
                    <div class="mt-4 space-y-4">
                        <label class="block">
                            <span>Event name</span> <span>*</span>
                            <span class="relative mt-1.5 flex">
                            <input
                                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Event Name"
                                type="text"
                                name="name"
                                autocomplete="off"
                                value="{{ $event->name }}"
                                required
                            />
                        </span>
                        </label>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Event Date Time</span> <span>*</span>
                                <span class="relative mt-1.5 flex">
                              <input
                                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                  placeholder="Event Date Time"
                                  type="text"
                                  autocomplete="off"
                                  id="event_date_time"
                                  name="event_date_time"
                                  value="{{ $event->event_date_time?->format('d/m/Y H:m')}}"
                                  required
                              />
                            </span>
                            </label>
                            <label class="block">
                                <span>Link</span>
                                <div class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Link"
                                        type="text"
                                        name="link"
                                        value="{{ $event->link }}"
                                        autocomplete="off"
                                    />
                                </div>
                            </label>
                        </div>

                        <label class="block">
                            <span>Description</span>
                            <textarea
                                rows="4"
                                placeholder="Description"
                                autocomplete="off"
                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            >{{ $event->description }}</textarea>
                        </label>
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

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
    <script src="http://cdn.craig.is/js/rainbow-custom.min.js"></script>
    <script>
        $('#event_date_time').datetimepicker({
            format:'d/m/Y H:m',
        });
    </script>
@endpush



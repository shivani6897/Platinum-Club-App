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
                href="{{url('business')}}"
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
        <li>Edit Business Expense</li>
    </ul>
@endsection

@section('content')

    <form method="POST"
          action="{{ route('expenses.update',$expense->id) }}"
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
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span class="relative mt-1.5 flex">Expense</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                     @error('expense')
                                        border-error
                                     @enderror"
                                    placeholder="expense"
                                    name="expense"
                                    type="text"
                                    value="{{ $expense->expense }}"
                                    required
                                    autocomplete="off"
                                />
                            </span>
                            @error('expense')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                        <label class="block">
                            <span class="required relative mt-1.5 flex">Date</span>
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
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                        <label class="block">
                        <span class="relative mt-1.5 flex">Description</span>
                        <textarea
                            rows="4"
                            placeholder="Description"
                            autocomplete="off"
                            name="description"
                            autocomplete="off"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                            {{ $expense->description }}
                        </textarea>
                        @error('description')
                        <span class="text-tiny+ text-error">{{$message}}</span>
                        @enderror
                    </label>
                    </div>

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
    </form>


@endsection

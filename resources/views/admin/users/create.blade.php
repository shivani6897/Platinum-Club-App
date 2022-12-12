@extends('admin.layouts.app')

@section('heading', 'User')

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
    <a
      class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
      href="{{route('admin.users.index')}}"
      >User</a
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
  <li>Create</li>
</ul>
@endsection

@section('content')
<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
    <div class="col-span-12">
        <div class=" p-4 sm:p-5">
            <p
                class="text-base font-medium text-slate-700 dark:text-navy-100"
            >
                User Create
            </p>
            <form method="POST"
                  action="{{ route('admin.users.store') }}"
                  accept-charset="UTF-8"
                  class="p-lg-5 p-3"
                  enctype="multipart/form-data"
            >
                @csrf
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <label class="block">
                            <span>User's Club</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                @error('club_id')
                                    border-error
                                @enderror"
                                name="club_id"
                                required
                            >
                                @foreach($clubs as $key=>$club)
                                    <option value="{{$club->id}}" @selected(old('club_id',0)==$club->id)>{{$club->name}}</option>
                                @endforeach
                            </select>
                            @error('club_id')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>First Name</span>
                            <span class="relative mt-1.5 flex">
                                  <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                        @error('first_name')
                                            border-error
                                        @enderror"
                                        placeholder="First Name"
                                        name="first_name"
                                        type="text"
                                        value="{{old('first_name')}}"
                                        required
                                  />
                            </span>
                            @error('first_name')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                          </label>
                        <label class="block">
                            <span>Last Name</span>
                            <span class="relative mt-1.5 flex">
                        <input
                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                          @error('last_name')
                                border-error
                          @enderror"
                            placeholder="Last Name"
                            name="last_name"
                            type="text"
                            value="{{old('last_name')}}"
                            required
                        />
                      </span>
                            @error('last_name')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                    </div>

                    <div id="oneTimeDiv" class="block">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>City</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                         @error('city')
                                            border-error
                                         @enderror"
                                        placeholder="Your City"
                                        name="city"
                                        type="text"
                                        value="{{old('city')}}"
                                        required
                                    />
                                </span>
                                @error('city')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class="block">
                                <span>Phone Number</span>
                                <span class="relative mt-1.5 flex">
                            <input
                                x-input-mask="{
                                    numeric:true,
                                    blocks: [3, 3, 4],
                                }"
                                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                              @error('phone_no')
                                    border-error
                              @enderror"
                                placeholder="Phone Number"
                                name="phone_no"
                                type="text"
                                value="{{old('phone_no')}}"
                                required
                            />
                          </span>
                                @error('phone_no')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                            <label class="block">
                                <span>Email</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                         @error('email')
                                            border-error
                                         @enderror"
                                        placeholder="Your Email"
                                        name="email"
                                        type="email"
                                        value="{{old('email')}}"
                                        required
                                    />
                                </span>
                                @error('email')
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
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush

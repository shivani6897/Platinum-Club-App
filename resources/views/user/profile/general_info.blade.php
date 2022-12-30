@extends('layouts.app')

@section('heading', 'Profile')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
    <li class="flex items-center space-x-2">
        <a
            class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
            href="#"
        >General Information</a
        >
{{--        <svg--}}
{{--            x-ignore--}}
{{--            xmlns="http://www.w3.org/2000/svg"--}}
{{--            class="h-4 w-4"--}}
{{--            fill="none"--}}
{{--            viewBox="0 0 24 24"--}}
{{--            stroke="currentColor"--}}
{{--        >--}}
{{--            <path--}}
{{--                stroke-linecap="round"--}}
{{--                stroke-linejoin="round"--}}
{{--                stroke-width="2"--}}
{{--                d="M9 5l7 7-7 7"--}}
{{--            />--}}
{{--        </svg>--}}
    </li>
{{--    <li>General Information</li>--}}
</ul>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12 grid lg:col-span-4 lg:place-items-center">
            <div>
                <ol
                    class="steps is-vertical line-space [--size:2.75rem] [--line:.5rem]"
                >
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-primary text-white dark:bg-accent"
                        >
                            <i class="fa-solid fa-layer-group text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 1
                            </p>
                            <h3
                                class="text-base font-medium text-primary dark:text-accent-light"
                            >
                                General Profile Details
                            </h3>
                        </div>
                    </li>
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100"
                        >
                            <i class="fa-solid fa-list text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 2
                            </p>
                            <h3 class="text-base font-medium">Business Physical Address</h3>
                        </div>
                    </li>
                    <li
                        class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                    >
                        <div
                            class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100"
                        >
                            <i class="fa-solid fa-truck-fast text-base"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Step 3
                            </p>
                            <h3 class="text-base font-medium">Authorized Contact Person</h3>
                        </div>
                    </li>
                </ol>
            </div>
        </div>

        <div class="col-span-12 grid lg:col-span-8">
            <div class="card">
                <div
                    class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5"
                >
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light"
                        >
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h4
                            class="text-lg font-medium text-slate-700 dark:text-navy-100"
                        >
                            General
                        </h4>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.profile.post') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$userdetails ? $userdetails->id : ''}}">

                    <div class="space-y-4 p-4 sm:p-5">

                        <div id="profilepicdiv">
                            <img src="{{asset($userdetails?->profile?'/images/users/'.$userdetails?->profile:'images/200x200.png')}}">
                        </div>
                        <label class="block" style="display: none;">
                            <span>Profile Picture </span>
                            <span class="relative mt-1.5 flex">
	                  			<input
                                    class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder=""
                                    type="file"
                                    id="profile_picture"
                                    name="profile"
                                />
	                  			<span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                >
	                    			<i class="fa-regular fa-user text-base"></i>
	                  			</span>
	                		</span>
                        </label>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>First Name*</span>

                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter your name"
                                type="text"
                                name="first_name"
                                value="{{ isset(auth()->user()->first_name) ? auth()->user()->first_name : old('first_name',$userdetails->first_name ?? '') }}"
                                required
                            />
                        </label>
                        <label class="block">
                            <span>Your Name*</span>

                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter your name"
                                type="text"
                                name="last_name"
                                value="{{ isset(auth()->user()->last_name) ? auth()->user()->last_name : old('last_name',$userdetails->last_name ?? '') }}"
                                required
                            />
                        </label>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>Email*</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter email "
                                type="email"
                                name="email"
                                required
                                value="{{ isset(auth()->user()->email) ? auth()->user()->email : old('email',$userdetails->email ?? '') }}"
                            />
                        </label>

                        <label class="block">
                            <span>Phone*</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Phone number"
                                type="number"
                                name="phone_no"
                                value="{{ isset(auth()->user()->phone_no) ? auth()->user()->phone_no : old('phone_no',$userdetails->phone_no ?? '') }}"
                                required
                            />
                        </label>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>Business Legal Name</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Business legal name"
                                type="text"
                                name="business_name"
                                value="{{ old('business_name',$userdetails->business_name ?? '') }}"
                            />
                        </label>
                        <label class="block">
                            <span>Business Niche</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                @error('business_id')
                                    border-error
                                @enderror"
                                name="business_id"
                                required
                            >
                                @foreach($businesses as $business)
                                    <option value="{{$business->id}}" @selected(old('business_id',0)==$business->id)>{{$business->name}}</option>
                                @endforeach
                            </select>
                            @error('business_id')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                    </div>
                    <label class="block">
                        <span>Business Website</span>
                        <input
                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Enter Business website"
                            name="business_website"
                            type="url"
                            value="{{ old('business_website',$userdetails->business_website ?? '') }}"

                        />
                    </label>
{{--                    <div>--}}
{{--                        <span>Images</span>--}}
{{--                        <div--}}
{{--                            class="filepond fp-bordered fp-grid mt-1.5 [--fp-grid:2]"--}}
{{--                        >--}}
{{--                            <input--}}
{{--                                type="file"--}}
{{--                                x-init="$el._x_filepond = FilePond.create($el)"--}}
{{--                                single--}}
{{--                                name="profile"--}}
{{--                                value="{{ old('profile',$userdetails->profile ?? '') }}"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="flex justify-center space-x-2 pt-4">
{{--                        <button--}}
{{--                            class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"--}}
{{--                            disabled--}}
{{--                        >--}}
{{--                            <svg--}}
{{--                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                class="h-5 w-5"--}}
{{--                                viewBox="0 0 20 20"--}}
{{--                                fill="currentColor"--}}
{{--                            >--}}
{{--                                <path--}}
{{--                                    fill-rule="evenodd"--}}
{{--                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"--}}
{{--                                    clip-rule="evenodd"--}}
{{--                                />--}}
{{--                            </svg>--}}
{{--                            <span>Prev</span>--}}
{{--                        </button>--}}
                        <button
                            type="submit"
                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                            <span>Next</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style type="text/css">
        #profilepicdiv img{
            border-radius: 50%;
            height: 80px;
            width: 80px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>

    <script type="text/javascript">
        function loadImage(input,img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(img).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#profile_picture').change(function(){
            loadImage(this,'#profilepicdiv img');
        });
        $('#profilepicdiv').click(function(){
            $('#profile_picture').click();
        });
    </script>
@endpush

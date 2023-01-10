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
        <li>Edit</li>
    </ul>
@endsection

@section('content')
    <div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12">
            <div class=" p-4 sm:p-5">
                <p
                    class="text-base font-medium text-slate-700 dark:text-navy-100"
                >
                    User Edit
                </p>
                <form method="post" action="{{route('admin.users.update',$user->id)}}">
                    @csrf
                    @method('PUT')
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
                                >

                                    <option value="">Select Club</option>
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
                                        value="{{ $user->first_name }}"
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
                                        value="{{ $user->last_name }}"
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
                                            value="{{ $user->city }}"
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
                                            value="{{ $user->phone_no }}"
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
                                        value="{{ $user->email }}"
                                        required
                                    />
                                </span>
                                @error('email')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>


                        {{--          <div id="recurringDiv" class="space-y-4 block" style="display: none;">--}}
                        {{--            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Start Date</span>--}}
                        {{--                <span class="relative flex">--}}
                        {{--                  <input--}}
                        {{--                    x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"--}}
                        {{--                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                    @error('start_date')--}}
                        {{--                    border-error--}}
                        {{--                    @enderror"--}}
                        {{--                    placeholder="Choose start date..."--}}
                        {{--                    type="text"--}}
                        {{--                    name="start_date"--}}
                        {{--                    value="{{old('start_date')}}"--}}
                        {{--                  />--}}
                        {{--                  <span--}}
                        {{--                      class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"--}}
                        {{--                    >--}}
                        {{--                    <svg--}}
                        {{--                      xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                      class="h-5 w-5 transition-colors duration-200"--}}
                        {{--                      fill="none"--}}
                        {{--                      viewBox="0 0 24 24"--}}
                        {{--                      stroke="currentColor"--}}
                        {{--                      stroke-width="1.5"--}}
                        {{--                    >--}}
                        {{--                      <path--}}
                        {{--                        stroke-linecap="round"--}}
                        {{--                        stroke-linejoin="round"--}}
                        {{--                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"--}}
                        {{--                      />--}}
                        {{--                    </svg>--}}
                        {{--                  </span>--}}
                        {{--                </span>--}}
                        {{--                @error('start_date')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--              <label class="block">--}}
                        {{--                <span>End Date</span>--}}
                        {{--                <span class="relative flex">--}}
                        {{--                  <input--}}
                        {{--                    x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"--}}
                        {{--                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                    @error('end_date')--}}
                        {{--                    border-error--}}
                        {{--                    @enderror"--}}
                        {{--                    placeholder="Choose end date..."--}}
                        {{--                    type="text"--}}
                        {{--                    name="end_date"--}}
                        {{--                    value="{{old('end_date')}}"--}}
                        {{--                  />--}}
                        {{--                  <span--}}
                        {{--                      class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"--}}
                        {{--                    >--}}
                        {{--                    <svg--}}
                        {{--                      xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                      class="h-5 w-5 transition-colors duration-200"--}}
                        {{--                      fill="none"--}}
                        {{--                      viewBox="0 0 24 24"--}}
                        {{--                      stroke="currentColor"--}}
                        {{--                      stroke-width="1.5"--}}
                        {{--                    >--}}
                        {{--                      <path--}}
                        {{--                        stroke-linecap="round"--}}
                        {{--                        stroke-linejoin="round"--}}
                        {{--                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"--}}
                        {{--                      />--}}
                        {{--                    </svg>--}}
                        {{--                  </span>--}}
                        {{--                </span>--}}
                        {{--                @error('end_date')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Time</span>--}}
                        {{--                <span class="relative flex">--}}
                        {{--                  <input--}}
                        {{--                    x-init="$el._x_flatpickr = flatpickr($el,{enableTime: true,noCalendar: true,dateFormat: 'H:i'})"--}}
                        {{--                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                    @error('recurring_time')--}}
                        {{--                    border-error--}}
                        {{--                    @enderror"--}}
                        {{--                    placeholder="Choose time..."--}}
                        {{--                    type="text"--}}
                        {{--                    name="recurring_time"--}}
                        {{--                    value="{{old('recurring_time')}}"--}}
                        {{--                  />--}}
                        {{--                  <span--}}
                        {{--                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"--}}
                        {{--                  >--}}
                        {{--                    <svg--}}
                        {{--                      xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                      class="h-5 w-5"--}}
                        {{--                      fill="none"--}}
                        {{--                      viewBox="0 0 24 24"--}}
                        {{--                      stroke="currentColor"--}}
                        {{--                      stroke-width="1.5"--}}
                        {{--                    >--}}
                        {{--                      <path--}}
                        {{--                        stroke-linecap="round"--}}
                        {{--                        stroke-linejoin="round"--}}
                        {{--                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"--}}
                        {{--                      />--}}
                        {{--                    </svg>--}}
                        {{--                  </span>--}}
                        {{--                </span>--}}
                        {{--                @error('recurring_time')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--            </div>--}}

                        {{--            <div class="grid grid-cols-1 gap-4">--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Frequency Type</span><br>--}}
                        {{--                <label class="inline-flex items-center space-x-2 pt-2">--}}
                        {{--                  <input--}}
                        {{--                    checked--}}
                        {{--                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"--}}
                        {{--                    name="frequency"--}}
                        {{--                    value="0"--}}
                        {{--                    @checked(old('frequency',1)==1)--}}
                        {{--                    type="radio"--}}
                        {{--                  />--}}
                        {{--                  <span>Daily</span>--}}
                        {{--                </label>--}}
                        {{--                <label class="inline-flex items-center space-x-2 pt-2">--}}
                        {{--                  <input--}}
                        {{--                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"--}}
                        {{--                    name="frequency"--}}
                        {{--                    value="1"--}}
                        {{--                    @checked(old('frequency',1)==2)--}}
                        {{--                    type="radio"--}}
                        {{--                  />--}}
                        {{--                  <span>Bi-Weekly</span>--}}
                        {{--                </label>--}}
                        {{--                <label class="inline-flex items-center space-x-2 pt-2">--}}
                        {{--                  <input--}}
                        {{--                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"--}}
                        {{--                    name="frequency"--}}
                        {{--                    value="2"--}}
                        {{--                    @checked(old('frequency',1)==3)--}}
                        {{--                    type="radio"--}}
                        {{--                  />--}}
                        {{--                  <span>Weekly</span>--}}
                        {{--                </label>--}}
                        {{--                <label class="inline-flex items-center space-x-2 pt-2">--}}
                        {{--                  <input--}}
                        {{--                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"--}}
                        {{--                    name="frequency"--}}
                        {{--                    value="3"--}}
                        {{--                    @checked(old('frequency',1)==4)--}}
                        {{--                    type="radio"--}}
                        {{--                  />--}}
                        {{--                  <span>Monthly</span>--}}
                        {{--                </label>--}}
                        {{--                @error('frequency')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--            </div>--}}

                        {{--            <div id="bi_weekly_div" class="grid grid-cols-1 gap-4 sm:grid-cols-2" style="display: none;">--}}
                        {{--              <label class="block">--}}
                        {{--                <span>First Day of the Week</span>--}}
                        {{--                <select--}}
                        {{--                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                  @error('day_of_week_1')--}}
                        {{--                  border-error--}}
                        {{--                  @enderror"--}}
                        {{--                  name="day_of_week_1"--}}
                        {{--                  required--}}
                        {{--                >--}}
                        {{--                  <option value="Monday" @selected(old('day_of_week_1','Monday')=='Monday')>Monday</option>--}}
                        {{--                  <option value="Tuesday" @selected(old('day_of_week_1','Monday')=='Tuesday')>Tuesday</option>--}}
                        {{--                  <option value="Wednesday" @selected(old('day_of_week_1','Monday')=='Wednesday')>Wednesday</option>--}}
                        {{--                  <option value="Thursday" @selected(old('day_of_week_1','Monday')=='Thursday')>Thursday</option>--}}
                        {{--                  <option value="Friday" @selected(old('day_of_week_1','Monday')=='Friday')>Friday</option>--}}
                        {{--                  <option value="Saturday" @selected(old('day_of_week_1','Monday')=='Saturday')>Saturday</option>--}}
                        {{--                  <option value="Sunday" @selected(old('day_of_week_1','Monday')=='Sunday')>Sunday</option>--}}
                        {{--                </select>--}}
                        {{--                @error('day_of_week_1')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Second Day of the Week</span>--}}
                        {{--                <select--}}
                        {{--                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                  @error('day_of_week_2')--}}
                        {{--                  border-error--}}
                        {{--                  @enderror"--}}
                        {{--                  name="day_of_week_2"--}}
                        {{--                  required--}}
                        {{--                >--}}
                        {{--                  <option value="Monday" @selected(old('day_of_week_1','Monday')=='Monday')>Monday</option>--}}
                        {{--                  <option value="Tuesday" @selected(old('day_of_week_1','Monday')=='Tuesday')>Tuesday</option>--}}
                        {{--                  <option value="Wednesday" @selected(old('day_of_week_1','Monday')=='Wednesday')>Wednesday</option>--}}
                        {{--                  <option value="Thursday" @selected(old('day_of_week_1','Monday')=='Thursday')>Thursday</option>--}}
                        {{--                  <option value="Friday" @selected(old('day_of_week_1','Monday')=='Friday')>Friday</option>--}}
                        {{--                  <option value="Saturday" @selected(old('day_of_week_1','Monday')=='Saturday')>Saturday</option>--}}
                        {{--                  <option value="Sunday" @selected(old('day_of_week_1','Monday')=='Sunday')>Sunday</option>--}}
                        {{--                </select>--}}
                        {{--                @error('day_of_week_2')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--            </div>--}}

                        {{--            <div id="weekly_div" class="grid grid-cols-1 gap-4" style="display: none;">--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Day of the Week</span>--}}
                        {{--                <select--}}
                        {{--                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                  @error('day_of_week')--}}
                        {{--                  border-error--}}
                        {{--                  @enderror"--}}
                        {{--                  name="day_of_week"--}}
                        {{--                  required--}}
                        {{--                >--}}
                        {{--                  <option value="Monday" @selected(old('day_of_week_2','Monday')=='Monday')>Monday</option>--}}
                        {{--                  <option value="Tuesday" @selected(old('day_of_week_2','Monday')=='Tuesday')>Tuesday</option>--}}
                        {{--                  <option value="Wednesday" @selected(old('day_of_week_2','Monday')=='Wednesday')>Wednesday</option>--}}
                        {{--                  <option value="Thursday" @selected(old('day_of_week_2','Monday')=='Thursday')>Thursday</option>--}}
                        {{--                  <option value="Friday" @selected(old('day_of_week_2','Monday')=='Friday')>Friday</option>--}}
                        {{--                  <option value="Saturday" @selected(old('day_of_week_2','Monday')=='Saturday')>Saturday</option>--}}
                        {{--                  <option value="Sunday" @selected(old('day_of_week_2','Monday')=='Sunday')>Sunday</option>--}}
                        {{--                </select>--}}
                        {{--                @error('day_of_week')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--            </div>--}}

                        {{--            <div id="monthly_div" class="grid grid-cols-1 gap-4" style="display: none;">--}}
                        {{--              <label class="block">--}}
                        {{--                <span>Day of the Month</span>--}}
                        {{--                <select--}}
                        {{--                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent--}}
                        {{--                  @error('day_of_month')--}}
                        {{--                  border-error--}}
                        {{--                  @enderror"--}}
                        {{--                  name="day_of_month"--}}
                        {{--                  required--}}
                        {{--                >--}}
                        {{--                @for($i=1;$i<32;$i++)--}}
                        {{--                  <option value="{{$i}}" @selected(old('day_of_week',1)==$i)>{{$i}}</option>--}}
                        {{--                @endfor--}}
                        {{--                </select>--}}
                        {{--                @error('day_of_month')--}}
                        {{--                  <span class="text-tiny+ text-error">{{$message}}</span>--}}
                        {{--                @enderror--}}
                        {{--              </label>--}}
                        {{--            </div>--}}

                        {{--          </div>--}}

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
@endpush

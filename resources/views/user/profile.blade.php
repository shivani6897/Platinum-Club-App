@extends('layouts.app')

@section('heading', 'Profile')

@section('content')
<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
	<div class="col-span-12 lg:col-span-4">
		<div class="card p-4 sm:p-5">
          	<div class="flex items-center space-x-4">
                <div class="avatar h-14 w-14">
                  <img
                    class="rounded-full"
                    src="{{asset('images/200x200.png')}}"
                    alt="avatar"
                  />
                </div>
                <div>
                  	<h3
                    	class="text-base font-medium text-slate-700 dark:text-navy-100"
                  	>
                    	{{Auth::user()->first_name}} {{Auth::user()->last_name}}
                  	</h3>
                    @if(Auth::user()->role == 2)
                  	    <p class="text-xs+">User</p>
                    @else
                        <p class="text-xs+">Admin</p>
                    @endif
                </div>
          	</div>
           	<ul class="mt-6 space-y-1.5 font-inter font-medium">
            	<li>
                  	<a
                    	class="group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                    	href="#"
                  	>
	                    <svg
	                    	xmlns="http://www.w3.org/2000/svg"
	                    	class="h-4 w-4"
	                    	fill="none"
	                    	viewBox="0 0 24 24"
	                    	stroke="currentColor"
	                    >
		                  	<path
		                  		stroke-linecap="round"
		                  		stroke-linejoin="round"
		                  		stroke-width="1.5"
		                  		d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
		                  	</path>
                		</svg>
                    	<span>{{Auth::user()->created_at->format('jS F, Y')}}</span>
                  	</a>
                </li>
                <li>
                  	<a
                    	class="group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                    	href="#"
                  	>
	                    <i class="fas fa-city"></i>
                    	<span>{{Auth::user()->city}}</span>
                  	</a>
                </li>
            </ul>
		</div>
	</div>
	<div class="col-span-12 lg:col-span-8">
        <div class="card">
          	<div
                class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5"
          	>
                <h2
                  class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100"
                >
                  Edit Profile
                </h2>
          	</div>

          	<form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
          		@csrf
          		<input type="hidden" name="user_id" value="{{$user ? $user->id : ''}}">
	          	<div class="p-4 sm:p-5">
	            	<div class="flex flex-col">
                	<span
                		class="text-base font-medium text-slate-600 dark:text-navy-100">
                		Avatar
                	</span>
                	<div class="avatar mt-5 h-20 w-20">
                  	<div
                    		class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700"
                  	>
              	  	<!-- <div class="filepond fp-bg-filled label-icon w-20">
							    		<input
							      	type="file"
							      	x-init="$el._x_filepond = FilePond.create($el,{
						            stylePanelAspectRatio: '1:0',
						            stylePanelLayout: 'compact circle',
						            labelIdle: `<svg xmlns='http://www.w3.org/2000/svg' class='h-3.5 w-3.5' viewBox='0 0 20 20' fill='currentColor'>
						              <path d='M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'/>
						            </svg>`
						          })"
						          name="profile"
						      		accept="image/png, image/jpeg"
							    		/>
					  				</div> -->
                      	<!-- <button
                        	class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                      	>
                        	<svg xmlns='http://www.w3.org/2000/svg' class='h-3.5 w-3.5' viewBox='0 0 20 20' fill='currentColor'>
                          	<path d='M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'
                          	/>
                        	</svg>
                      	</button> -->
                  	</div>
                	</div>
                </div>
	            	<div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
	            	<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
	              		<label class="block">
	                		<span>First name </span>
	                		<span class="relative mt-1.5 flex">
	                  			<input
	                    			class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
	                    			placeholder="First Name"
				                  	type="text"
				                  	id="first_name"
				                  	name="first_name"
				                  	value="{{ $user ? $user->first_name : '' }}"
				                  	required
				                  	autocomplete="first_name"
				                  	autofocus
	              				/>
	                  			<span
	                    			class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
	                  			>
	                    			<i class="fa-regular fa-user text-base"></i>
	                  			</span>
	                		</span>
	              		</label>
	              		<label class="block">
	                		<span>Last Name </span>
	                			<span class="relative mt-1.5 flex">
	                      			<input
	                        			class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
	                        			placeholder="Last Name"
					                  	type="text"
					                  	id="last_name"
					                  	name="last_name"
					                  	value="{{ $user ? $user->last_name : '' }}"
					                  	autocomplete="last_name"
					                  	autofocus
	                      			/>
	                  			<span
	                    			class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
	                  			>
	                    			<i class="fa-regular fa-user text-base"></i>
	                  			</span>
	                		</span>
	              		</label>
	              		<label class="block">
	                		<span>Phone Number</span>
	                		<span class="relative mt-1.5 flex">
	                			<span
				                  	class="flex shrink-0 items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450"
			                	>
			                		<span>IN (+91)</span>
			                	</span>
	                  			<input
				                  	x-input-mask="{
				                      	numeric:true,
				                      	blocks: [3, 3, 4],
				                  	}"
				                  	class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
				                  	placeholder="Phone No."
				                  	type="text"
				                  	id="phone_no"
				                  	name="phone_no"
				                  	value="{{ $user ? $user->phone_no : '' }}"
				                  	required
				                  	autocomplete="phone_no"
				                  	autofocus
				                />
	                		</span>
	              		</label>
	              		<label class="block">
	                		<span>City </span>
	                		<span class="relative mt-1.5 flex">
	                  			<input
	                    			class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
	                    			placeholder="City"
				                  	type="text"
				                  	id="city"
				                  	name="city"
				                  	value="{{ $user ? $user->city : '' }}"
				                  	required
				                  	autocomplete="city"
				                  	autofocus
	              				/>
	                  			<span
	                    			class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
	                  			>
	                    			<i class="fa-regular fa-user text-base"></i>
	                  			</span>
	                		</span>
	              		</label>
	            	</div>
	          	</div>
	          	<div
	                class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5"
	              >
	                <div class="flex justify-center space-x-2">
	                  	<a
		                    class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
		                    href="{{url('home')}}"
		                  >
	                    	Cancel
	                  	</a>
	                  	<button
	                    	class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
	                    	type="submit"
	                  	>
	                    	Save
	                  	</button>
	                </div>
	          	</div>
          	</form>
        </div>
  	</div>
</div>
@endsection

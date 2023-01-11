<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>{{config('app.name') }} - Sign Up</title>
    <link rel="icon" type="image/png" href="/images/favicon.png" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="/css/app.css" />

    <!-- Javascript Assets -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div
      class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
    >
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div
      id="root"
      class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
      x-cloak
    >
      <main class="grid w-full grow grid-cols-1 place-items-center">
        <div class="w-full max-w-[26rem] p-4 sm:px-5">
          <div class="text-center">
            <img
              class="mx-auto h-16 w-16"
              src="/images/app-logo.png"
              alt="logo"
            />
            <div class="mt-4">
              <h2
                class="text-2xl font-semibold text-slate-600 dark:text-navy-100"
              >
                Welcome To Plantinum Club App
              </h2>
              <p class="text-slate-400 dark:text-navy-300">
                Please sign up to continue
              </p>
            </div>
          </div>
          <form method="POST" action="{{ route('customer.verify.register') }}">
            @csrf
            <div class="card mt-5 rounded-lg p-5 lg:p-7">
              <label class="relative flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="First Name"
                  type="text"
                  id="first_name"
                  name="first_name"
                  value="{{ old('first_name') }}"
                  required 
                  autocomplete="first_name" 
                  autofocus
                />
              </label> 
              @error('first_name')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror           
              <label class="relative mt-4 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="Last Name"
                  type="text"
                  id="last_name"
                  name="last_name"
                  value="{{ old('last_name') }}"
                  required 
                  autocomplete="last_name" 
                  autofocus
                />
              </label>    
              @error('last_name')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror        
              <label class="relative mt-4 flex">
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
                  value="{{ old('phone_no') }}"
                  required 
                  autocomplete="phone_no" 
                  autofocus
                />
              </label>   
              @error('phone_no')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror           
              <label class="relative mt-4 flex">
                <select
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  id="state_id"
                  name="state_id"
                  required 
                >
                <option value="" disabled @selected(old('state_id',0)==0)>Select State</option>
                @foreach($states as $state)
                  <option value="{{$state->id}}" @selected(old('state_id',0)==$state->id)>{{$state->name}}</option>
                @endforeach
                </select>
              </label>
              <p class="text-tiny+ text-info">Required for GST calculations.</p>
              @error('state_id')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <label class="relative mt-4 flex">
                <select
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  id="club_id"
                  name="club_id"
                  value="{{ old('club_id') }}"
                  required 
                >
                <option value="" disabled @selected(old('club_id',0)==0)>Select Club</option>
                @foreach($clubs as $club)
                  <option value="{{$club->id}}">{{$club->name}}</option>
                @endforeach
                </select>
              </label>
              <p class="text-tiny+ text-info">Required and cannot be changed afterwards.</p>
              @error('club_id')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <label class="relative mt-4 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="Email"
                  id="email" 
                  type="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  name="email" 
                  value="{{ old('email') }}" 
                  required 
                  autocomplete="email"
                />
              </label>
              @error('email')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <label class="relative mt-4 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="Password"
                  id="password" 
                  type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  name="password" 
                  required 
                  autocomplete="new-password"
                />
              </label>
              @error('password')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <label class="relative mt-4 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="Repeat Password"
                  id="password-confirm" 
                  type="password" 
                  class="form-control" 
                  name="password_confirmation" 
                  required 
                  autocomplete="new-password"
                />
              </label>
              <button
                class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                type="submit"
              >
                Sign Up
              </button>
            </div>
          </form>
        </div>
      </main>
    </div>

  <div x-data="{showModal:false}">
    <button
      @click="showModal = true"
      class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
    >
      Origin Top
    </button>
    <template x-teleport="#x-teleport-target">
      <div
        class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
        x-show="showModal"
        role="dialog"
        @keydown.window.escape="showModal = false"
      >
        <div
          class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
          @click="showModal = false"
          x-show="showModal"
          x-transition:enter="ease-out"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="ease-in"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
        ></div>
        <div
          class="relative w-full max-w-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
          x-show="showModal"
          x-transition:enter="easy-out"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="easy-in"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
        >
          <div
            class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
          >
            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
              Edit Pin
            </h3>
            <button
              @click="showModal = !showModal"
              class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4.5 w-4.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                ></path>
              </svg>
            </button>
          </div>
          <div class="px-4 py-4 sm:px-5">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Assumenda incidunt
            </p>
            <div class="mt-4 space-y-4">
              <label class="block">
                <span>Choose category :</span>
                <select
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                  <option>Laravel</option>
                  <option>Node JS</option>
                  <option>Django</option>
                  <option>Other</option>
                </select>
              </label>
              <label class="block">
                <span>Description:</span>
                <textarea
                  rows="4"
                  placeholder=" Enter Text"
                  class="form-textarea mt-1.5 w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                ></textarea>
              </label>
              <label class="block">
                <span>Website Address:</span>
                <input
                  class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="URL Address"
                  type="text"
                />
              </label>
              <label class="inline-flex items-center space-x-2">
                <input
                  class="form-switch is-outline h-5 w-10 rounded-full border border-slate-400/70 bg-transparent before:rounded-full before:bg-slate-300 checked:border-primary checked:before:bg-primary dark:border-navy-400 dark:before:bg-navy-300 dark:checked:border-accent dark:checked:before:bg-accent"
                  type="checkbox"
                />
                <span>Public pin</span>
              </label>
              <div class="space-x-2 text-right">
                <button
                  @click="showModal = false"
                  class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                  Cancel
                </button>
                <button
                  @click="showModal = false"
                  class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >
                  Apply
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </div>

    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>

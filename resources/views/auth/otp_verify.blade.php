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

    <title>{{config('app.name') }} - Verify OTP</title>
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
                Please verify otp on your phone to proceed
              </p>
            </div>
          </div>
          <form method="POST" action="{{ route('customer.verify.register.attempt') }}">
            @csrf
            <input type="hidden" name="regData" value="{{json_encode(session()->get('regData'))}}">
            <div class="card mt-5 rounded-lg p-5 lg:p-7">      
              <label class="relative mt-4 flex">
                <input
                  x-input-mask="{
                      numeric:true,
                      blocks: [1, 1, 1, 1, 1, 1],
                  }"
                  class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                  placeholder="Enter OTP"
                  type="text"
                  id="otp"
                  name="otp"
                  required 
                />
              </label>   
              @error('otp')
                <span class="text-tiny+ text-error">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <button
                class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                type="submit"
              >
                Verify and register
              </button>
            </div>
          </form>
        </div>
      </main>
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

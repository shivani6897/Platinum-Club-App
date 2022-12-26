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

    <title>{{config('app.name') }} - Sign In</title>
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    <!-- Javascript Assets -->
    <script src="{{asset('js/app.js')}}" defer></script>

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
              src="{{asset('images/app-logo.png')}}"
              alt="logo"
            />
            <div class="mt-4">
              <h2
                class="text-2xl font-semibold text-slate-600 dark:text-navy-100"
              >
                {{ __('Set Password') }}
              </h2>
            </div>
          </div>
            @if (session('status'))
                <div class="alert flex rounded-lg border border-success/30 bg-success/10 py-4 px-4 text-success sm:px-5" role="alert">
                    {{ session('status') }}
                </div>
            @endif
          <form method="POST" action="{{ route('customer.password.set',$token) }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="card mt-5 rounded-lg p-5 lg:p-7">
                @error('token')
                    <span class="text-tiny+ text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="relative flex">
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
                {{ __('Set Password') }}
              </button>
            </div>
          </form>
        </div>
      </main>
    </div>
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>


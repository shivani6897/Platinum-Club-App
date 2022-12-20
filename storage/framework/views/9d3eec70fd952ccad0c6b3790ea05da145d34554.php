<div class="main-sidebar">
  <div
    class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800"
  >
    <!-- Application Logo -->
    <div class="flex pt-4">
      <a href="/">
        <img
          class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
          src="<?php echo e(asset('images/app-logo.png')); ?>"
          alt="logo"
        />
      </a>
    </div>

    <!-- Main Sections Links -->
    <div
      class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6 main-sidebar-links"
    >
      <!-- Dashobards -->
      <a
        href="<?php echo e(route('home')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Dashboards'"
      >
        <i class="fa-solid fa-house fa-2x"></i>
      </a>

      <!-- Customer -->
      <a
        href="<?php echo e(route('customers.index')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Customers'"
      >
        <i class="fa-solid fa-users fa-2x"></i>
      </a>
        <!-- TODO Products -->
        <a
        href="<?php echo e(route('products.index')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Products'"
      >
            <i class="fa-brands fa-product-hunt fa-2x"></i>
      </a>
        <!-- TODO Subscription -->
        <a href="<?php echo e(route('subscription.index')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Subscription'">
            <i class="fa-sharp fa-solid fa-s fa-2x"></i>
      </a>

      <!-- Invoice -->
      <a
        href="<?php echo e(route('invoices.index')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Invoices'"
      >
        <i class="fa-solid fa-file-invoice fa-2x"></i>
      </a>

      <!-- My Business -->
        <a
          href="<?php echo e(route('incomes.index')); ?>"
          class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          x-tooltip.placement.right="'My Business'"
        >
          <i class="fa-solid fa-building fa-2x"></i>
        </a>

      <!-- Tasks -->
      <a
        href="<?php echo e(route('tasks.index')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        x-tooltip.placement.right="'Reminders'"
      >
        <i class="fa-solid fa-rectangle-list fa-2x"></i>
      </a>

      <!-- Tasks Calendar -->
      

      <!-- Habits -->
        

      <!-- Events -->
      <a
          href="<?php echo e(route('events')); ?>"
          class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          x-tooltip.placement.right="'Events'"
      >
          <i class="fa-solid fa-calendar-days fa-2x"></i>
      </a>

        <!-- Dashobards -->
      <a
        href="<?php echo e(route('top_performers')); ?>"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'20 Top Performers'"
      >
        <i class="fa-solid fa-ranking-star fa-2x"></i>
      </a>

        
    </div>

    <!-- Bottom Links -->
    <div class="flex flex-col items-center space-y-3 py-3">

      <!-- Profile -->
      <div
        x-data="usePopper({placement:'right-end',offset:12})"
        @click.outside="if(isShowPopper) isShowPopper = false"
        class="flex"
      >
        <button
          @click="isShowPopper = !isShowPopper"
          x-ref="popperRef"
          class="avatar h-12 w-12"
        >
          <img
            class="rounded-full"
            src="/images/200x200.png"
            alt="avatar"
          />
          <span
            class="absolute right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"
          ></span>
        </button>

        <div
          :class="isShowPopper && 'show'"
          class="popper-root fixed"
          x-ref="popperRoot"
        >
          <div
            class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700"
          >
            <div
              class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800"
            >
              <div class="avatar h-14 w-14">
                <img
                  class="rounded-full"
                  src="<?php echo e(asset('images/200x200.png')); ?>"
                  alt="avatar"
                />
              </div>
              <div>
                <a
                  href="#"
                  class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                >
                  <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?>

                </a>
              </div>
            </div>
            <div class="flex flex-col pt-2 pb-5">
              <a
                href="<?php echo e(route('profile', Auth::user()->id)); ?>"
                class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
              >
                <div
                  class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning text-white"
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
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg>
                </div>

                <div>
                  <h2
                    class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light"
                  >
                    Profile
                  </h2>
                  <div
                    class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                  >
                    Your profile setting
                  </div>
                </div>
              </a>
              <div class="mt-3 px-4">
                <a
                  class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                  href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                  </svg>
                  <span>Logout</span>
                </a>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\laragon\www\platinum\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>
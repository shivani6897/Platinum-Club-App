<!-- App Header Wrapper-->
<nav class="header print:hidden">
  <!-- App Header  -->
  <div
    class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden"
  >
    <!-- Header Items -->
    <div class="flex w-full items-center justify-between">
      <!-- Left: Sidebar Toggle Button -->
      <div class="h-7 w-7">
        <a title="Sharable link" href="<?php echo e(route('landing.index',auth()->id())); ?>" target="_blank">
          <svg style="height:20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M352 224c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96c0 4 .2 8 .7 11.9l-94.1 47C145.4 170.2 121.9 160 96 160c-53 0-96 43-96 96s43 96 96 96c25.9 0 49.4-10.2 66.6-26.9l94.1 47c-.5 3.9-.7 7.8-.7 11.9c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-25.9 0-49.4 10.2-66.6 26.9l-94.1-47c.5-3.9 .7-7.8 .7-11.9s-.2-8-.7-11.9l94.1-47C302.6 213.8 326.1 224 352 224z"/></svg>
        </a>
        
      </div>

      <!-- Right: Header buttons -->
      <div class="-mr-1.5 flex items-center space-x-2">
        <!-- Mobile Search Toggle -->
        <button
          @click="$store.global.isSearchbarActive = !$store.global.isSearchbarActive"
          class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:hidden"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5.5 w-5.5 text-slate-500 dark:text-navy-100"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="1.5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            />
          </svg>
        </button>

        

        <!-- Dark Mode Toggle -->
        <button
          @click="$store.global.isDarkModeEnabled = !$store.global.isDarkModeEnabled"
          class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        >
          <svg
            x-show="$store.global.isDarkModeEnabled"
            x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
            x-transition:enter-start="scale-75"
            x-transition:enter-end="scale-100 static"
            class="h-6 w-6 text-amber-400"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              d="M11.75 3.412a.818.818 0 01-.07.917 6.332 6.332 0 00-1.4 3.971c0 3.564 2.98 6.494 6.706 6.494a6.86 6.86 0 002.856-.617.818.818 0 011.1 1.047C19.593 18.614 16.218 21 12.283 21 7.18 21 3 16.973 3 11.956c0-4.563 3.46-8.31 7.925-8.948a.818.818 0 01.826.404z"
            />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            x-show="!$store.global.isDarkModeEnabled"
            x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
            x-transition:enter-start="scale-75"
            x-transition:enter-end="scale-100 static"
            class="h-6 w-6 text-amber-400"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
        <!-- Monochrome Mode Toggle -->
        <button
          @click="$store.global.isMonochromeModeEnabled = !$store.global.isMonochromeModeEnabled"
          class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        >
          <i
            class="fa-solid fa-palette bg-gradient-to-r from-sky-400 to-blue-600 bg-clip-text text-lg font-semibold text-transparent"
          ></i>
        </button>

        
      </div>
    </div>
  </div>
</nav>

<!-- Mobile Searchbar -->
<div
  x-show="$store.breakpoints.isXs && $store.global.isSearchbarActive"
  x-transition:enter="easy-out transition-all"
  x-transition:enter-start="opacity-0 scale-105"
  x-transition:enter-end="opacity-100 scale-100"
  x-transition:leave="easy-in transition-all"
  x-transition:leave-start="opacity-100 scale-100"
  x-transition:leave-end="opacity-0 scale-95"
  class="fixed inset-0 z-[100] flex flex-col bg-white dark:bg-navy-700 sm:hidden"
>
  <div
    class="flex items-center space-x-2 bg-slate-100 px-3 pt-2 dark:bg-navy-800"
  >
    <button
      class="btn -ml-1.5 h-7 w-7 shrink-0 rounded-full p-0 text-slate-600 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
      @click="$store.global.isSearchbarActive = false"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        stroke-width="1.5"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M15 19l-7-7 7-7"
        />
      </svg>
    </button>
    <input
      x-effect="$store.global.isSearchbarActive && $nextTick(() => $el.focus() );"
      class="form-input h-8 w-full bg-transparent placeholder-slate-400 dark:placeholder-navy-300"
      type="text"
      placeholder="Search here..."
    />
  </div>
</div><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/layouts/header.blade.php ENDPATH**/ ?>
<div class="main-sidebar">
  <div
    class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800"
  >
    <!-- Application Logo -->
    <div class="flex pt-4">
      <a href="/">
        <img
          class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
          src="{{asset('images/app-logo.svg')}}"
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
        href="{{route('home')}}"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        x-tooltip.placement.right="'Dashboards'"
      >
        <svg
          class="h-7 w-7"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M5 14.0585C5 13.0494 5 12.5448 5.22166 12.1141C5.44333 11.6833 5.8539 11.3901 6.67505 10.8035L10.8375 7.83034C11.3989 7.42938 11.6795 7.2289 12 7.2289C12.3205 7.2289 12.6011 7.42938 13.1625 7.83034L17.325 10.8035C18.1461 11.3901 18.5567 11.6833 18.7783 12.1141C19 12.5448 19 13.0494 19 14.0585V19C19 19.9428 19 20.4142 18.7071 20.7071C18.4142 21 17.9428 21 17 21H7C6.05719 21 5.58579 21 5.29289 20.7071C5 20.4142 5 19.9428 5 19V14.0585Z"
            fill-opacity="0.3"
            class="fill-primary dark:fill-accent"
          />
          <path
            d="M3 12.3866C3 12.6535 3 12.7869 3.0841 12.8281C3.16819 12.8692 3.27352 12.7873 3.48418 12.6234L10.7721 6.95502C11.362 6.49625 11.6569 6.26686 12 6.26686C12.3431 6.26686 12.638 6.49625 13.2279 6.95502L20.5158 12.6234C20.7265 12.7873 20.8318 12.8692 20.9159 12.8281C21 12.7869 21 12.6535 21 12.3866V11.9782C21 11.4978 21 11.2576 20.8983 11.0497C20.7966 10.8418 20.607 10.6944 20.2279 10.3995L13.2279 4.95502C12.638 4.49625 12.3431 4.26686 12 4.26686C11.6569 4.26686 11.362 4.49625 10.7721 4.95502L3.77212 10.3995C3.39295 10.6944 3.20337 10.8418 3.10168 11.0497C3 11.2576 3 11.4978 3 11.9782V12.3866Z"
            class="fill-primary dark:fill-accent"
          />
          <path
            d="M12.5 15H11.5C10.3954 15 9.5 15.8954 9.5 17V20.85C9.5 20.9328 9.56716 21 9.65 21H14.35C14.4328 21 14.5 20.9328 14.5 20.85V17C14.5 15.8954 13.6046 15 12.5 15Z"
            class="fill-primary dark:fill-accent"
          />
          <rect
            x="16"
            y="5"
            width="2"
            height="4"
            rx="0.5"
            class="fill-primary dark:fill-accent"
          />
        </svg>
      </a>

      <!-- Tasks -->
      <a
        href="{{route('tasks.index')}}"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        x-tooltip.placement.right="'Tasks'"
      >
        <svg
          class="h-7 w-7"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-opacity="0.3"
            d="M21.0001 16.05V18.75C21.0001 20.1 20.1001 21 18.7501 21H6.6001C6.9691 21 7.3471 20.946 7.6981 20.829C7.7971 20.793 7.89609 20.757 7.99509 20.712C8.31009 20.586 8.61611 20.406 8.88611 20.172C8.96711 20.109 9.05711 20.028 9.13811 19.947L9.17409 19.911L15.2941 13.8H18.7501C20.1001 13.8 21.0001 14.7 21.0001 16.05Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
          <path
            fill-opacity="0.5"
            d="M17.7324 11.361L15.2934 13.8L9.17334 19.9111C9.80333 19.2631 10.1993 18.372 10.1993 17.4V8.70601L12.6384 6.26701C13.5924 5.31301 14.8704 5.31301 15.8244 6.26701L17.7324 8.17501C18.6864 9.12901 18.6864 10.407 17.7324 11.361Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
          <path
            d="M7.95 3H5.25C3.9 3 3 3.9 3 5.25V17.4C3 17.643 3.02699 17.886 3.07199 18.12C3.09899 18.237 3.12599 18.354 3.16199 18.471C3.20699 18.606 3.252 18.741 3.306 18.867C3.315 18.876 3.31501 18.885 3.31501 18.885C3.32401 18.885 3.32401 18.885 3.31501 18.894C3.44101 19.146 3.585 19.389 3.756 19.614C3.855 19.731 3.95401 19.839 4.05301 19.947C4.15201 20.055 4.26 20.145 4.377 20.235L4.38601 20.244C4.61101 20.415 4.854 20.559 5.106 20.685C5.115 20.676 5.11501 20.676 5.11501 20.685C5.25001 20.748 5.385 20.793 5.529 20.838C5.646 20.874 5.76301 20.901 5.88001 20.928C6.11401 20.973 6.357 21 6.6 21C6.969 21 7.347 20.946 7.698 20.829C7.797 20.793 7.89599 20.757 7.99499 20.712C8.30999 20.586 8.61601 20.406 8.88601 20.172C8.96701 20.109 9.05701 20.028 9.13801 19.947L9.17399 19.911C9.80399 19.263 10.2 18.372 10.2 17.4V5.25C10.2 3.9 9.3 3 7.95 3ZM6.6 18.75C5.853 18.75 5.25 18.147 5.25 17.4C5.25 16.653 5.853 16.05 6.6 16.05C7.347 16.05 7.95 16.653 7.95 17.4C7.95 18.147 7.347 18.75 6.6 18.75Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
        </svg>
      </a>

      <!-- Tasks Calendar -->
      <a
        href="{{route('tasks.calendar')}}"
        class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        x-tooltip.placement.right="'Tasks Calender'"
      >
        <svg
          class="h-7 w-7"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-opacity="0.3"
            d="M21.0001 16.05V18.75C21.0001 20.1 20.1001 21 18.7501 21H6.6001C6.9691 21 7.3471 20.946 7.6981 20.829C7.7971 20.793 7.89609 20.757 7.99509 20.712C8.31009 20.586 8.61611 20.406 8.88611 20.172C8.96711 20.109 9.05711 20.028 9.13811 19.947L9.17409 19.911L15.2941 13.8H18.7501C20.1001 13.8 21.0001 14.7 21.0001 16.05Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
          <path
            fill-opacity="0.5"
            d="M17.7324 11.361L15.2934 13.8L9.17334 19.9111C9.80333 19.2631 10.1993 18.372 10.1993 17.4V8.70601L12.6384 6.26701C13.5924 5.31301 14.8704 5.31301 15.8244 6.26701L17.7324 8.17501C18.6864 9.12901 18.6864 10.407 17.7324 11.361Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
          <path
            d="M7.95 3H5.25C3.9 3 3 3.9 3 5.25V17.4C3 17.643 3.02699 17.886 3.07199 18.12C3.09899 18.237 3.12599 18.354 3.16199 18.471C3.20699 18.606 3.252 18.741 3.306 18.867C3.315 18.876 3.31501 18.885 3.31501 18.885C3.32401 18.885 3.32401 18.885 3.31501 18.894C3.44101 19.146 3.585 19.389 3.756 19.614C3.855 19.731 3.95401 19.839 4.05301 19.947C4.15201 20.055 4.26 20.145 4.377 20.235L4.38601 20.244C4.61101 20.415 4.854 20.559 5.106 20.685C5.115 20.676 5.11501 20.676 5.11501 20.685C5.25001 20.748 5.385 20.793 5.529 20.838C5.646 20.874 5.76301 20.901 5.88001 20.928C6.11401 20.973 6.357 21 6.6 21C6.969 21 7.347 20.946 7.698 20.829C7.797 20.793 7.89599 20.757 7.99499 20.712C8.30999 20.586 8.61601 20.406 8.88601 20.172C8.96701 20.109 9.05701 20.028 9.13801 19.947L9.17399 19.911C9.80399 19.263 10.2 18.372 10.2 17.4V5.25C10.2 3.9 9.3 3 7.95 3ZM6.6 18.75C5.853 18.75 5.25 18.147 5.25 17.4C5.25 16.653 5.853 16.05 6.6 16.05C7.347 16.05 7.95 16.653 7.95 17.4C7.95 18.147 7.347 18.75 6.6 18.75Z"
            class="fill-slate-500 dark:fill-navy-200"
          />
        </svg>
      </a>

      <!-- Habits -->
        <a
            href="{{route('habits.index')}}"
            class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            x-tooltip.placement.right="'Habits'"
        >

            <svg
                class="h-7 w-7"
                viewBox="0 0 152 152"
                xmlns="http://www.w3.org/2000/svg">
                <g
                    id="Layer_2"
                    data-name="Layer 2"
                >
                <g
                    id="_02.bullseye"
                    data-name="02.bullseye"
                >
                    <circle
                        id="background"
                        cx="76"
                        cy="76"
                        fill="#5e3ace"
                        r="76"
                    />
                    <g fill="#fff">
                        <path
                            d="m76 44a32 32 0 1 1 -32 32 32 32 0 0 1 32-32m0-13a45 45 0 1 0 45 45 45 45 0 0 0 -45-45z"
                        />
                        <path
                            d="m76 68.37a7.63 7.63 0 1 1 -7.63 7.63 7.64 7.64 0 0 1 7.63-7.63m0-13a20.66 20.66 0 1 0 20.66 20.63 20.66 20.66 0 0 0 -20.66-20.66z"/>
                        </g>
                    </g>
                </g>
            </svg>
        </a>

      <!-- Events -->
      <a
          href="{{route('events')}}"
          class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          x-tooltip.placement.right="'Events'"
      >
          <svg enable-background="new 0 0 492 492"
               class="h-7 w-7"
               viewBox="0 0 492 492"
               xmlns="http://www.w3.org/2000/svg">
              <g id="Layer_2">
                  <path
                      clip-rule="evenodd"
                      d="m246.26.98c135.21 0 245.76 110.549 245.76 245.76 0 135.21-110.549 245.76-245.76 245.76-135.21 0-245.76-110.55-245.76-245.76 0-135.21 110.55-245.76 245.76-245.76z"
                      fill="#00acc1"
                      fill-rule="evenodd"
                      style="fill: rgb(94, 58, 206);">
                  </path>
              </g>
              <g id="Layer_1">
                  <g>
                      <g clip-rule="evenodd" fill="#fffffe" fill-rule="evenodd">
                          <path
                              d="m295.012 184.131h-97.502c-1.632 0-2.954-1.322-2.954-2.954v-15.722h-40.909v215.685h185.228v-215.685h-40.909v15.722c0 1.631-1.323 2.954-2.954 2.954zm-107.353 42.395c1.153-1.154 3.024-1.154 4.177 0l5.527 5.527 15.548-15.548c1.153-1.153 3.024-1.153 4.177 0s1.153 3.024 0 4.177l-17.636 17.636c-.577.577-1.333.865-2.089.865s-1.512-.288-2.089-.865l-7.615-7.616c-1.153-1.153-1.153-3.023 0-4.176zm29.429 100.572-17.636 17.636c-.554.554-1.305.865-2.089.865-.783 0-1.535-.311-2.089-.865l-7.616-7.615c-1.153-1.153-1.153-3.024 0-4.177s3.024-1.153 4.177 0l5.527 5.527 15.548-15.547c1.153-1.153 3.024-1.153 4.177 0 1.155 1.152 1.155 3.022.001 4.176zm0-53.208-17.636 17.636c-.554.554-1.305.865-2.089.865-.783 0-1.535-.311-2.089-.865l-7.616-7.616c-1.153-1.153-1.153-3.024 0-4.177s3.024-1.153 4.177 0l5.527 5.526 15.548-15.548c1.153-1.153 3.024-1.153 4.177 0 1.155 1.155 1.155 3.025.001 4.179zm85.685 71.163h-65.053c-1.632 0-2.954-1.323-2.954-2.954s1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.323 2.954 2.954s-1.323 2.954-2.954 2.954zm0-16.542h-65.053c-1.632 0-2.954-1.323-2.954-2.954s1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.322 2.954 2.954s-1.323 2.954-2.954 2.954zm0-36.666h-65.053c-1.632 0-2.954-1.322-2.954-2.954 0-1.631 1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.322 2.954 2.954s-1.323 2.954-2.954 2.954zm0-16.544h-65.053c-1.632 0-2.954-1.322-2.954-2.954s1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.322 2.954 2.954s-1.323 2.954-2.954 2.954zm0-36.666h-65.053c-1.632 0-2.954-1.323-2.954-2.954s1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.322 2.954 2.954s-1.323 2.954-2.954 2.954zm2.954-19.495c0 1.631-1.322 2.954-2.954 2.954h-65.053c-1.632 0-2.954-1.322-2.954-2.954s1.322-2.954 2.954-2.954h65.053c1.631 0 2.954 1.322 2.954 2.954z"
                              fill="#fffffe">
                          </path>
                          <path
                              d="m264.266 130.345c0-4.81-1.873-9.332-5.273-12.732-3.401-3.401-7.923-5.274-12.732-5.274-9.928 0-18.006 8.077-18.006 18.006v4.03h36.011z"
                              fill="#fffffe"
                          >
                          </path>
                          <path
                              d="m206.129 140.283c-3.124 0-5.666 2.542-5.666 5.666v32.274h91.595v-32.274c0-3.124-2.542-5.666-5.666-5.666z"
                              fill="#fffffe"
                          >
                          </path>
                      </g>
                  </g>
              </g>
          </svg>
      </a>

        <!-- My Business -->
        <a
          href="{{url('business')}}"
          class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          x-tooltip.placement.right="'My Business'"
        >
          <i class="fa-solid fa-building"></i>
        </a>

        <!-- Business Stats -->
        <a
          href="{{url('business-stats')}}"
          class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          x-tooltip.placement.right="'Business Stats'"
        >
          <svg
            class="h-7 w-7"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M13.3111 14.75H5.03356C3.36523 14.75 2.30189 12.9625 3.10856 11.4958L5.24439 7.60911L7.24273 3.96995C8.07689 2.45745 10.2586 2.45745 11.0927 3.96995L13.1002 7.60911L14.0627 9.35995L15.2361 11.4958C16.0427 12.9625 14.9794 14.75 13.3111 14.75Z"
              class="fill-slate-500 dark:fill-navy-200"
            />
            <path
              fill-opacity="0.3"
              d="M21.1667 15.2083C21.1667 18.4992 18.4992 21.1667 15.2083 21.1667C11.9175 21.1667 9.25 18.4992 9.25 15.2083C9.25 15.0525 9.25917 14.9058 9.26833 14.75H13.3108C14.9792 14.75 16.0425 12.9625 15.2358 11.4958L14.0625 9.36C14.4292 9.28666 14.8142 9.25 15.2083 9.25C18.4992 9.25 21.1667 11.9175 21.1667 15.2083Z"
              class="fill-slate-500 dark:fill-navy-200"
            />
          </svg>
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
            src="{{asset('images/200x200.png')}}"
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
                  src="{{asset('images/200x200.png')}}"
                  alt="avatar"
                />
              </div>
              <div>
                <a
                  href="#"
                  class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                >
                  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </a>
              </div>
            </div>
            <div class="flex flex-col pt-2 pb-5">
              <a
                href="{{route('profile', Auth::user()->id)}}"
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
                  href="{{ route('logout') }}"
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
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

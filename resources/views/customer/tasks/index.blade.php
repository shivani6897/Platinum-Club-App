@extends('layouts.app')

@section('heading', 'Reminder')

@section('breadcrums')
<div class="hidden h-full py-1 sm:flex">
  <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
</div>
<ul class="hidden flex-wrap items-center space-x-2 sm:flex">
  <li class="flex items-center space-x-2">
    <a
      class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
      href="{{route('home')}}"
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
    
  </li>
  <li>Reminders</li>
</ul>
@endsection

@section('content')
{{-- Calendar --}}
{{-- <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:gap-6"> --}}
<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
  <div class="col-span-12">
    <div class=" p-4 sm:p-5">
      <p
        class="text-base font-medium text-slate-700 dark:text-navy-100"
      >
        Reminder Calendar
      </p>
      <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
    <div class="container mx-auto px-4 py-2 md:py-24">
        
      <!-- <div class="font-bold text-gray-800 text-xl mb-4">
        Schedule Tasks
      </div> -->

      <div class="bg-white rounded-lg shadow overflow-hidden">

        <div class="flex items-center justify-between py-2 px-6">
          <div>
            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
          </div>
          <div class="border rounded-lg px-1" style="padding-top: 2px;">
            <button 
              type="button"
              class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
              :class="{'cursor-not-allowed opacity-25': month == 0 }"
              {{-- :disabled="month == 0 ? true : false" --}}
              onclick="changeMonth({{request('month',date('n'))}},{{request('year',date('Y'))}},'sub')"
              >
              {{-- @click="month--; getNoOfDays()"> --}}
              <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>  
            </button>
            <div class="border-r inline-flex h-6"></div>    
            <button 
              type="button"
              class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
              :class="{'cursor-not-allowed opacity-25': month == 11 }"
              {{-- :disabled="month == 11 ? true : false" --}}
              onclick="changeMonth({{request('month',date('n'))}},{{request('year',date('Y'))}},'add')">
              {{-- @click="month++; getNoOfDays()"> --}}
              <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>                    
            </button>
          </div>
        </div>  

        <div class="-mx-1 -mb-1">
          <div class="flex flex-wrap" style="margin-bottom: -40px;">
            <template x-for="(day, index) in DAYS" :key="index">  
              <div style="width: 14.26%" class="px-2 py-2">
                <div
                  x-text="day" 
                  class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
              </div>
            </template>
          </div>

          <div class="flex flex-wrap border-t border-l">
            <template x-for="blankday in blankdays">
              <div 
                style="width: 14.28%; height: 120px"
                class="text-center border-r border-b px-4 pt-2" 
              ></div>
            </template> 
            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex"> 
              <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                <div
                  style="cursor: pointer;"
                  x-bind:onclick="`completeTask(this,${event.event_theme})`"
                  {{-- @click="showEventModal(date)" --}}
                  x-text="date"
                  class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                  :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"  
                ></div>
                <div style="height: 80px;" class="overflow-y-auto mt-1">
                  <!-- <div 
                    class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                    x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                    x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                  <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">  
                  <form method="get" x-bind:action="`{{url('/tasks/complete')}}/${event.event_id}`">
                    <div
                      style="cursor: pointer;"
                       x-bind:onclick="`completeTask(this,'${event.event_theme}')`"
                      class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                      :class="{
                        'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                        'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                        'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                        'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                        'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple',
                        'border border-info text-info': event.event_theme == 'info',
                        'border border-success text-success': event.event_theme == 'success',
                      }"
                    >
                      <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                    </div>
                  </form>
                  </template>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
      <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
        <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
          x-on:click="openEventModal = !openEventModal">
          <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
          </svg>
        </div>

        <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
          
          <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Add Event Details</h2>
         
          <div class="mb-4">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event title</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_title">
          </div>

          <div class="mb-4">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event date</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
          </div>

          <div class="inline-block w-64 mb-4">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Select a theme</label>
            <div class="relative">
              <select @change="event_theme = $event.target.value;" x-model="event_theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                  <template x-for="(theme, index) in themes">
                    <option :value="theme.value" x-text="theme.label"></option>
                  </template>
                
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
          </div>
 
          <div class="mt-8 text-right">
            <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
              Cancel
            </button> 
            <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click="addEvent()">
              Save Event
            </button> 
          </div>
        </div>
      </div>
    </div>
    <!-- /Modal -->
  </div>
    </div>
  </div>
</div>

{{-- Table --}}
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6 mt-5">
  <!-- Users Table -->
  <div>
    <div class="flex items-center justify-between">
      <h2
        class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
      >
        Reminder Table
      </h2>
      <div class="flex">
        <div class="flex items-center" x-data="{isInputActive:false}">
          {{-- <label class="block">
            <span class="relative mr-1.5 flex">
              <input
                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Search here..."
                onchange="tableSearch(this)"
                name="search"
                type="text"
                value="{{request('search','')}}"
              />
            </span>
          </label> --}}
          {{-- <label class="block">
            <input
              x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
              :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
              class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
              placeholder="Search here..."
              onchange="tableSearch(this)"
              value="{{request('search','')}}"
              type="text"
            />
          </label>
          <button
            @click="isInputActive = !isInputActive"
            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4.5 w-4.5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </button> --}}
        </div>
        <div
          class="inline-flex"
        >
        <a href="{{route('tasks.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Reminder</a>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div
        class="is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table id="reminders-table" class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                #
              </th>
              <th
                data-title="category"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Category
              </th>
              <th
                data-title="name"
                data-order=""
                class="sort-by whitespace-nowrap flex bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                data-title="type"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Type
              </th>
              <th
                data-title="frequency"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Frequency
              </th>
              <th
                data-title="start_date"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Start Date
              </th>
              <th
                data-title="end_date"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                End Date
              </th>
              <th
                data-title="status"
                data-order=""
                class="sort-by whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Status
              </th> 
              <th
                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Action
              </th>
            </tr>
            <form id="filterForm">
              <input type="hidden" id="table_sort" name="sort">
              <input type="hidden" id="table_order" name="order">
              <tr>
                <th></th>
                <th>
                  <label class="block">
                    <span class="relative mr-1.5 flex">
                      <input
                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="Category"
                        name="category"
                        type="text"
                        value="{{request('category','')}}"
                      />
                    </span>
                  </label>
                </th>
                <th>
                  <label class="block">
                    <span class="relative mr-1.5 flex">
                      <input
                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="Name"
                        name="name"
                        type="text"
                        value="{{request('name','')}}"
                      />
                    </span>
                  </label>
                </th>
                <th>
                  <label class="block">
                    <select
                      class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                      name="type"
                    >
                      <option value="">All</option>
                      <option value="0" @selected(request('type','')==0)>One-Time</option>
                      <option value="1" @selected(request('type','')==1)>Recurring</option>
                    </select>
                  </label>
                </th>
                <th>
                  <label class="block">
                    <select
                      class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                      name="frequency"
                    >
                      <option value="">All</option>
                      <option value="0" @selected(request('frequency','')==0)>No Repeat</option>
                      <option value="1" @selected(request('frequency','')==1)>Daily</option>
                      <option value="2" @selected(request('frequency','')==2)>Bi-weekly</option>
                      <option value="3" @selected(request('frequency','')==3)>Weekly</option>
                      <option value="4" @selected(request('frequency','')==4)>Monthly</option>
                    </select>
                  </label>
                </th>
                <th>
                  <label class="relative flex">
                  <input
                    x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',altInput: true,dateFormat: 'Y-m-d',altFormat: 'd-m-Y'})"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Start Date"
                    name="start_date"
                    type="text"
                    value="{{request('start_date','')}}"
                  />
                  <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5 transition-colors duration-200"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                </label>
                </th>
                <th>
                  <label class="relative flex">
                  <input
                    x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',altInput: true,dateFormat: 'Y-m-d',altFormat: 'd-m-Y' })"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="End Date"
                    name="end_date"
                    type="text"
                    value="{{request('end_date','')}}"
                  />
                  <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5 transition-colors duration-200"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                </label>
                </th>
                <th>
                  <label class="block">
                    <select
                      class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                      name="status"
                    >
                      <option value="">All</option>
                      <option value="0" @selected(request('status','')==0)>Pending</option>
                      <option value="1" @selected(request('status','')==1)>Completed</option>
                    </select>
                  </label>
                </th>
                <th style="min-width: 120px;">
                  <button class="btn space-x-2 bg-primary mr-2 font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"><i class="fa-solid fa-filter"></i></button><a href="{{route('tasks.index')}}" class="btn space-x-2 ml-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"><i class="fa-solid fa-rotate-right"></i></a>
                </th>
              </tr>

            </form>
          </thead>
            @forelse($tasks as $task)
              <tr
                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
              >
                <td
                  class="whitespace-nowrap px-4 py-3 sm:px-5"
                >{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$task->task_category->name}}
                </td>
                <td
                  class="whitespace-nowrap px-3 py-3 sm:px-5"
                >{{$task->name}}</td>
                <td
                  class="whitespace-nowrap px-4 py-3 sm:px-5"
                >{!!($task->type==0?'<div class="badge rounded-full border border-warning text-warning">One-Time</div>':'<div class="badge rounded-full border border-info text-info">Recurring</div>')!!}</td>
                <td
                  class="whitespace-nowrap px-4 py-3 sm:px-5"
                >{{$task->getFrequency()}}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {{($task->type==1?$task->start_date->format('d-m-Y H:i'):$task->task_date->format('d-m-Y H:i'))}}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {{($task->type==1?$task->end_date->format('d-m-Y H:i'):'')}}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {!!($task->completed==1?'<div class="badge rounded-full border border-success text-success">Completed</div>':'<div class="badge rounded-full border border-info text-info">Pending</div>')!!}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <div
                    x-data="usePopper({placement:'bottom-end',offset:4})"
                    @click.outside="if(isShowPopper) isShowPopper = false"
                    class="inline-flex"
                  >
                    <button
                      x-ref="popperRef"
                      @click="isShowPopper = !isShowPopper"
                      class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                        />
                      </svg>
                    </button>

                    <div
                      x-ref="popperRoot"
                      class="popper-root"
                      :class="isShowPopper && 'show'"
                    >
                      <div
                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                      >
                        <ul>
                          <li>
                            <a
                              href="{{route('tasks.edit',$task->id)}}"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Edit</a
                            >
                          </li>
                          @if($task->completed==0)
                          <li>
                            <a
                              href="{{route('tasks.complete',$task->id)}}"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Complete</a
                            >
                          </li>
                          @endif
                          <li>
                            <form method="post" action="{{route('tasks.destroy',$task->id)}}">
                              @method('delete')
                              @csrf
                              <button
                                type="button"
                                onclick="taskDelete(this)"
                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                >Delete</button>
                              </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td class="text-center p-5" colspan="10">No Data...</td>
              </tr>
              @endforelse
          </tbody>
        </table>
      </div>

      <div
        class="paginate-div flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
      >
        {{-- <div class="text-xs+">1 - 10 of 10 entries</div> --}}

        {{$tasks->links()}}

        {{-- <ol class="pagination">
          <li class="rounded-l-full bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 19l-7-7 7-7"
                />
              </svg>
            </a>
          </li>
          <li class="bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
              >1</a
            >
          </li>
          <li class="bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full bg-primary px-3 leading-tight text-white transition-colors hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
              >2</a
            >
          </li>
          <li class="bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
              >3</a
            >
          </li>
          <li class="bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
              >4</a
            >
          </li>
          <li class="bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
              >5</a
            >
          </li>
          <li class="rounded-r-full bg-slate-150 dark:bg-navy-500">
            <a
              href="#"
              class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
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
                  stroke-width="2"
                  d="M9 5l7 7-7 7"
                />
              </svg>
            </a>
          </li>
        </ol> --}}
      </div>
    </div>
  </div>
</div>

{{-- </div> --}}
@endsection

@push('styles')
<style>
    [x-cloak] {
      display: none;
    }
  </style>
<style>
  .sort-by {
    position: relative;
    cursor: pointer;
  }
  .sort-by:after {
    font-family: "Font Awesome 6 Free";
   content: "\f0dc";
   display: inline-block;
   padding-right: 3px;
   vertical-align: middle;
   font-weight: 900;
   position: absolute;
   right: 5px;
  }
  .sort-by.asc:after {
    font-family: "Font Awesome 6 Free";
   content: "\f0d8";
   display: inline-block;
   padding-right: 3px;
   vertical-align: middle;
   font-weight: 900;
   position: absolute;
   right: 5px;
  }
  .sort-by.desc:after {
    font-family: "Font Awesome 6 Free";
   content: "\f0d7";
   display: inline-block;
   padding-right: 3px;
   vertical-align: middle;
   font-weight: 900;
   position: absolute;
   right: 5px;
  }
</style>
@endpush

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function changeMonth(month,year,operation)
    {
      $('<form></form>')
        .append('<input type="hidden" name="month" value="'+month+'">')
        .append('<input type="hidden" name="year" value="'+year+'">')
        .append('<input type="hidden" name="operation" value="'+operation+'">')
        .appendTo('body')
        .submit()
        .remove();
    }

    function completeTask(obj,flg)
    {
      if(flg=='success')
      {
        Swal.fire(
              'info!',
              'Task Completed',
              'info'
            );
      }
      else
      {
        Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to complete this task?!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#5e3ace',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Complete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Warning!',
              'Completing Task',
              'warning'
            );
            $(obj).closest('form').submit();
          }
        });
      }
    }

    function app() {
      return {
        month: '',
        year: '',
        no_of_days: [],
        blankdays: [],
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

        events: [
          @foreach($data as $value)
          {
            event_id: {{$value['event_id']}},
            event_date: new Date({{explode('-',$value['event_date'])[0]}}, {{explode('-',$value['event_date'])[1]-1}}, {{explode('-',$value['event_date'])[2]}}),
            event_title: "{{$value['event_title']}}",
            event_theme: '{{$value['event_theme']}}',
          }@if(!$loop->last),
          @endif
          @endforeach
          // {
          //   event_date: new Date(2022, 3, 1),
          //   event_title: "April Fool's Day",
          //   event_theme: 'blue'
          // },

          // {
          //   event_date: new Date(2022, 3, 10),
          //   event_title: "Birthday",
          //   event_theme: 'red'
          // },

          // {
          //   event_date: new Date(2022, 3, 16),
          //   event_title: "Upcoming Event",
          //   event_theme: 'green'
          // }
        ],
        event_title: '',
        event_date: '',
        event_theme: 'blue',

        themes: [
          {
            value: "blue",
            label: "Blue Theme"
          },
          {
            value: "red",
            label: "Red Theme"
          },
          {
            value: "yellow",
            label: "Yellow Theme"
          },
          {
            value: "green",
            label: "Green Theme"
          },
          {
            value: "purple",
            label: "Purple Theme"
          }
        ],

        openEventModal: false,

        initDate() {
          let today = new Date();
          this.month = {{request('month',date('n'))-1}};//today.getMonth();
          this.year = {{request('year',date('Y'))}};//today.getFullYear();
          this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
        },

        isToday(date) {
          const today = new Date();
          const d = new Date(this.year, this.month, date);

          return today.toDateString() === d.toDateString() ? true : false;
        },

        showEventModal(date) {
          // open the modal
          // this.openEventModal = true;
          // this.event_date = new Date(this.year, this.month, date).toDateString();
        },

        addEvent() {
          if (this.event_title == '') {
            return;
          }

          this.events.push({
            event_date: this.event_date,
            event_title: this.event_title,
            event_theme: this.event_theme
          });

          console.log(this.events);

          // clear the form data
          this.event_title = '';
          this.event_date = '';
          this.event_theme = 'blue';

          //close the modal
          this.openEventModal = false;
        },

        getNoOfDays() {
          let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

          // find where to start calendar day of week
          let dayOfWeek = new Date(this.year, this.month).getDay();
          let blankdaysArray = [];
          for ( var i=1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
          }

          let daysArray = [];
          for ( var i=1; i <= daysInMonth; i++) {
            daysArray.push(i);
          }
          
          this.blankdays = blankdaysArray;
          this.no_of_days = daysArray;
        }
      }
    }
</script>
<script>
  function tableSearch(obj)
  {
    $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
  }
  function taskDelete(obj)
  {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5e3ace',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Warning!',
          'Deleting Task',
          'warning'
        );
        $(obj).closest('form').submit();
      }
    })
  }
  $(document).ready(function(){
    $('#reminders-table th.sort-by').click(function(e){
      console.log($(this).data('title'),$(this).data('order'));
      if($(this).data('order')=='asc')
      {
        $('#reminders-table th.sort-by').data('order','').removeClass('asc desc');
        $(this).data('order','desc').removeClass('asc').addClass('desc');
        $('#reminders-table #table_sort').val($(this).data('title'));
        $('#reminders-table #table_order').val('desc');
      }
      else
      {
        $('#reminders-table th.sort-by').data('order','').removeClass('asc desc');
        $(this).data('order','asc').removeClass('desc').addClass('asc');
        $('#reminders-table #table_sort').val($(this).data('title'));
        $('#reminders-table #table_order').val('asc');
      }
      $('#filterForm').submit();
    });

    // Filter on load
    var filter_span = $('th.sort-by[data-title="{{request('sort','id')}}"]');
    @if(request('order','asc')=='asc')
      $('#reminders-table th.sort-by').data('order','').removeClass('asc desc');
      filter_span.data('order','asc').removeClass('desc').addClass('asc');
      $('#reminders-table #table_sort').val(filter_span.data('title'));
      $('#reminders-table #table_order').val('asc');

    @else
      $('#reminders-table th.sort-by').data('order','').removeClass('asc desc');
      filter_span.data('order','desc').removeClass('asc').addClass('desc');
      $('#reminders-table #table_sort').val(filter_span.data('title'));
      $('#reminders-table #table_order').val('desc');

    @endif
  })
</script>
@endpush

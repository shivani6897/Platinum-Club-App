@extends('layouts.app')

@section('heading', 'Tasks')

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
  <li>Tasks</li>
</ul>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
  <!-- Users Table -->
  <div>
    <div class="flex items-center justify-between">
      <h2
        class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
      >
        Tasks Table
      </h2>
      <div class="flex">
        <div class="flex items-center" x-data="{isInputActive:false}">
          <label class="block">
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
          </label>
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
        <a href="{{route('tasks.create')}}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Add Task</a>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div
        class="is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                #
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Category
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Type
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Frequency
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Start Date
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                End Date
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Time
              </th> 
              <th
                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Action
              </th>
            </tr>
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
                  {{($task->type==1?$task->start_date->format('d-m-Y'):$task->task_date->format('d-m-Y'))}}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {{($task->type==1?$task->end_date->format('d-m-Y'):'')}}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {{($task->type==1?$task->task_time->format('h:i A'):$task->task_date->format('h:i A'))}}
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
                <td class="text-center p-5" colspan="9">No Data...</td>
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
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</script>
@endpush

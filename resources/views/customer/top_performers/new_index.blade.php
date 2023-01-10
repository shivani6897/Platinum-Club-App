@extends('layouts.app')

@section('heading', 'Top performers')

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
  <li>20 Top Performers</li>
</ul>
@endsection

@section('content')

    <div class="mt-3 mb-9">

      <div
        class="card is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
      	<div class=" p-4 m-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"> Top 20 Performers</div>

        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>
            @forelse($stats as $stat)
              <tr
                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
              >
                <td
                  class="whitespace-nowrap px-4 py-3 sm:px-5"
                >{{$loop->iteration}}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  {{$stat->user?->first_name}} {{$stat->user?->last_name}}
                </td>
                <td
                  class="whitespace-nowrap px-3 py-3 sm:px-5"
                >{{$stat->user?->club?->name}}</td>
                <td
                  class="whitespace-nowrap px-3 py-3 sm:px-5"
                >₹ {{number_format($stat->revenue,2)}}</td>
              </tr>
              @empty
              <tr>
                <td class="text-center p-5" colspan="9">No Data...</td>
              </tr>
              @endforelse
          </tbody>
        </table>
      </div>
    </div>


<div class=" p-4 m-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"> Top 5 Performers</div>


 <div class="grid grid-cols-12  gap-4 sm:gap-5 lg:gap-6">
  	<div class="card col-span-12 lg:col-span-6 mb-8">
		<h4 class="pl-4 p-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
      {{ isset($topFive[0]?->name) ? $topFive[0]?->name : 'No Club Found' }}
    </h4>

    	<div
        class="card is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >

        <table class="is-hoverable text-left m-4">
          <thead>
            <tr>
              <!-- <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th> -->
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>

              @forelse($topFive as $stat)
                  @if($stat->id == 1)
                    @foreach($stat->users as  $user)
                      <tr
                        class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                      >
                        <!-- <td
                          class="whitespace-nowrap px-4 py-3 sm:px-5"
                        >{{$loop->iteration}}</td> -->
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                          {{$user->first_name}} {{$user->last_name}}
                        </td>
                        <td
                          class="whitespace-nowrap px-3 py-3 sm:px-5"
                        >{{$stat->name}}</td>
                        <td
                          class="whitespace-nowrap px-3 py-3 sm:px-5"
                        >₹ {{number_format($user->incomes_sum_income,2)}}</td>
                      </tr>
                    @endforeach
                  @endif
                @empty
                <tr>
                  <td class="text-center p-5" colspan="9">No Data...</td>
                </tr>

                @endforelse
          </tbody>
        </table>
      </div>
  	</div>


  	<div class="card col-span-12 lg:col-span-6 mb-8">
      <h4 class="pl-4 p-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
        {{ isset($topFive[1]?->name) ? $topFive[1]?->name : 'No Club Found' }}
      </h4>
    	<div
        class="card is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable text-left m-4">
          <thead>
            <tr>
              <!-- <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th> -->
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>
              @forelse($topFive as $stat)
                @if($stat->id ==2)
                  @foreach($stat->users as  $user)

                    <tr
                      class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                    >
                      <!-- <td
                        class="whitespace-nowrap px-4 py-3 sm:px-5"
                      >{{$loop->iteration}}</td> -->
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{$user->first_name}} {{$user->last_name}}
                      </td>
                      <td
                        class="whitespace-nowrap px-3 py-3 sm:px-5"
                      >{{$stat->name}}</td>
                      <td
                        class="whitespace-nowrap px-3 py-3 sm:px-5"
                      >₹ {{number_format($user->incomes_sum_income,2)}}</td>

                      {{-- ₹ {{number_format($stat->revenue,2)}} --}}
                      </td>
                    </tr>
                  @endforeach
                @endif


                @empty
                <tr>
                  <td class="text-center p-5" colspan="9">No Data...</td>
                </tr>
              @endforelse
      

          </tbody>
        </table>
      </div>
  	</div>

	<div class="card col-span-12 lg:col-span-6  mb-8">
  		<div class="pl-4 p-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"> 
        {{ isset($topFive[2]?->name) ? $topFive[2]?->name : 'No Club Found' }}
      </div>
    	<div
        class="card is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable text-left m-4">
          <thead>
            <tr>
              <!-- <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th> -->
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>
            @forelse($topFive as $stat)
              @if($stat->id ==3)
                @foreach($stat->users as  $user)


                  <tr
                    class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                  >
                    <!-- <td
                      class="whitespace-nowrap px-4 py-3 sm:px-5"
                    >{{$loop->iteration}}</td> -->
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                      {{$user->first_name}} {{$user->last_name}}
                    </td>
                    <td
                      class="whitespace-nowrap px-3 py-3 sm:px-5"
                    >{{$stat->name}}</td>
                    <td
                      class="whitespace-nowrap px-3 py-3 sm:px-5"
                      >₹ {{number_format($user->incomes_sum_income,2)}}</td>
                  </tr>
                @endforeach
              @endif

            @empty
            <tr>
              <td class="text-center p-5" colspan="9">No Data...</td>
            </tr>
            @endforelse
            
          </tbody>
        </table>
      </div>
  	</div>


  	<div class="card col-span-12 lg:col-span-6 mb-8">
  		<div class="pl-4 p-2 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"> 
        {{ isset($topFive[3]?->name) ? $topFive[3]?->name : 'No Club Found' }}

      </div>

    	<div
        class="card is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable text-left m-4">
          <thead>
            <tr>
              <!-- <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th> -->
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>
              @forelse($topFive as $stat)
                @if($stat->id == 4) 
                  @foreach($stat->users as  $user)


                    <tr
                      class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                    >
                      <!-- <td
                        class="whitespace-nowrap px-4 py-3 sm:px-5"
                      >{{$loop->iteration}}</td> -->
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{$stat->users->first()->first_name}} {{$stat->users->first()->last_name}}
                      </td>
                      <td
                        class="whitespace-nowrap px-3 py-3 sm:px-5"
                      >{{$stat->name}}</td>
                      <td
                        class="whitespace-nowrap px-3 py-3 sm:px-5"
                      >₹ {{number_format($stat->users->first()->incomes_sum_income,2)}}</td>
                    </tr>
                    @endforeach
                  @endif
                @empty
                <tr>
                  <td class="text-center p-5" colspan="9">No Data...</td>
                </tr>
                @endforelse
              </tbody>
        </table>
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

@extends('admin.layouts.app')

@section('heading', 'Dashboard')

@section('breadcrums')
<div class="hidden h-full py-1 sm:flex">
  <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
</div>
<ul class="hidden flex-wrap items-center space-x-2 sm:flex">
  <li>Dashboard</li>
</ul>
@endsection

@section('content')
<div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
  <div class="card col-span-12 pb-4">
    <div class="mt-3 flex items-center justify-between px-4 sm:px-5">
      <h2
        class="text-sm+ font-medium tracking-wide text-slate-700 dark:text-navy-100"
      >
        Statistics
      </h2>

      <div class="flex items-center space-x-4">
        {{-- <div
          class="hidden cursor-pointer items-center space-x-2 sm:flex"
        >
          <div class="h-3 w-3 rounded-full bg-accent"></div>
          <p>Current Period</p>
        </div>
        <div
          class="hidden cursor-pointer items-center space-x-2 sm:flex"
        >
          <div class="h-3 w-3 rounded-full" style="background-color: #febc3b;"></div>
          <p>Previous Period</p>
        </div> --}}
        <form>
        <select
          name="club"
          class="form-select h-8 rounded-full border border-slate-300 bg-white px-2.5 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
        >
          <option value="0" @selected(request('club',0)==0)>All Clubs</option>
          @foreach($clubs as $club)
          <option value="{{$club->id}}" @selected(request('club',0)==$club->id)>{{$club->name}}</option>
          @endforeach
        </select>
        <select
          name="user"
          class="form-select h-8 rounded-full border border-slate-300 bg-white px-2.5 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
        >
          <option value="0" @selected(request('user',0)==0)>All Users</option>
          @foreach($users as $user)
          <option value="{{$user->id}}" @selected(request('user',0)==$user->id)>{{$user->first_name}} {{$user->last_name}}</option>
          @endforeach
        </select>
        <select
          name="duration"
          class="form-select h-8 rounded-full border border-slate-300 bg-white px-2.5 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
        >
          <option value="0" @selected(request('duration',0)==0)>All Time</option>
          <option value="1" @selected(request('duration',0)==1)>Last year</option>
          <option value="2" @selected(request('duration',0)==2)>Last Month</option>
        </select>
        </form>
      </div>
    </div>
    <div class="mt-3 grid grid-cols-12">
      <div class="col-span-12 px-4 sm:col-span-6 sm:px-5 lg:col-span-4">
        <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-8">
          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Revenue Earned</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->revenue_earned,2)}}</p>
            </div>
            <div
              class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Ad spends</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->ad_spends,2)}}</p>
            </div>
            <div
              class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Overheads</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->overheads,2)}}</p>
            </div>
            <div
              class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-indigo-400 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Net Profit</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->net_profit,2)}}</p>
            </div>
            <div
              class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Profitability%</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">{{number_format($stat->profitability,2)}} %</p>
            </div>
            <div
              class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Average cost per lead</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->cost_per_lead,2)}}</p>
            </div>
            <div
              class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Leads Generated</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white"><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{number_format($stat->leads_generated)}}</p>
            </div>
            <div
              class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Paid Customers</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">{{number_format($stat->paid_customer)}}</p>
            </div>
            <div
              class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>

          <div
            class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 p-3.5"
          >
            <p class="text-xs uppercase text-sky-100">Total Group Size</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">{{number_format($stat->total_customer)}}</p>
            </div>
            <div
              class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"
            ></div>
          </div>
        </div>
      </div>
      <div
        class="ax-transparent-gridline col-span-12 px-2 sm:col-span-6 lg:col-span-8"
      >
      <div id="statisticChart"></div>
        {{-- <div
          x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el, analyticsPagesViews); $el._x_chart.render() });"
        ></div> --}}
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script type="text/javascript">
var options = {
          series: [{
          name: 'Profit',
          data: {!!json_encode($profitability['y'])!!},
          // [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07,
          //   5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, -27.03, -54.4, -47.2, -43.3, -18.6, -
          //   48.6, -41.1, -39.6, -37.6, -29.4, -21.4, -2.4
          // ]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            colors: {
              ranges: [{
                from: -100,
                to: -46,
                color: '#F15B46'
              }, {
                from: -45,
                to: 0,
                color: '#FEB019'
              }]
            },
            columnWidth: '80%',
          }
        },
        dataLabels: {
          enabled: false,
        },
        yaxis: {
          title: {
            text: 'Profitability%',
          },
          labels: {
            formatter: function (y) {
              return y.toFixed(0) + "%";
            }
          }
        },
        xaxis: {
          type: 'datetime',
          categories: {!!json_encode($profitability['x'])!!},
          // [
          //   '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
          //   '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
          //   '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
          //   '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
          //   '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
          //   '2013-07-01', '2013-08-01', '2013-09-01'
          // ],
          labels: {
            rotate: -90
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#statisticChart"), options);
        chart.render();

$(document).ready(function(){
    $('select[name="duration"],select[name="user"],select[name="club"]').change(function(e){
        $(this).closest('form').submit();
    });
});
</script>
@endpush

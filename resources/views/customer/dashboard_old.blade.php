@extends('layouts.app')

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
                <h2 class="text-sm+ font-medium tracking-wide text-slate-700 dark:text-navy-100">
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
                    <div id="reportrange" name="duration"
                        class="form-select p-2 rounded-full border border-slate-300 bg-white px-2.5 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span id="date-duration"></span>
                    </div>
                </div>

                {{-- end  --}}
            </div>
            <div class="mt-3 grid grid-cols-12">
                <div class="col-span-12 px-4 sm:px-5">
                    <div class="mt-6 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
                        <div
                            class="bg-tr relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
                            <p class="text-xs uppercase text-sky-100">Total Revenue</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->revenue_earned, 2) }}</p>
                            </div>
                            <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-as relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Ad spend</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->ad_spends, 2) }}</p>
                            </div>
                            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-ohrelative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Overheads</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->overheads, 2) }}</p>
                            </div>
                            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-np relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-indigo-400 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Net Profit</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->net_profit, 2) }}</p>
                            </div>
                            <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-lg relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Leads Generated</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->leads_generated) }}</p>
                            </div>
                            <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-cpl relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Cost per lead</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white"><i
                                        class="fa-sharp fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($stat->cost_per_lead, 2) }}</p>
                            </div>
                            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-ctc relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
                            <p class="text-xs uppercase text-sky-100">Converted to Customers</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white">{{ number_format($stat->paid_customer) }}
                                </p>
                            </div>
                            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-tc relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Total Customers</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white">{{ number_format($stat->total_customer) }}
                                </p>
                            </div>
                            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>

                        <div
                            class="bg-pb relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 p-3.5">
                            <p class="text-xs uppercase text-sky-100">Profitability%</p>
                            <div class="flex items-end justify-between space-x-2">
                                <p class="mt-4 text-2xl font-medium text-white">
                                    {{ number_format($stat->profitability, 2) }}
                                    %</p>
                            </div>
                            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                        </div>
                    </div>
                </div>
                <div class="ax-transparent-gridline col-span-12 px-2">
                    <div id="statisticChart"></div>
                    {{-- <div
          x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el, analyticsPagesViews); $el._x_chart.render() });"
        ></div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /*.bg-tr {
            background: rgb(73, 90, 228);
            background: linear-gradient(90deg, rgba(73, 90, 228, 1) 15%, rgba(7, 24, 157, 0.9654061453683036) 93%);
        }

        .bg-as {
            background: rgb(187, 4, 4);
            background: linear-gradient(90deg, rgba(187, 4, 4, 0.9542016635755864) 16%, rgba(247, 63, 63, 1) 86%);
        }

        .bg-oh {
            background: rgb(240, 44, 44);
            background: linear-gradient(90deg, rgba(240, 44, 44, 1) 22%, rgba(187, 4, 4, 0.9542016635755864) 93%);
        }

        .bg-np {
            background: rgb(4, 135, 3);
            background: linear-gradient(90deg, rgba(4, 135, 3, 1) 37%, rgba(49, 230, 44, 0.9766106271610207) 93%);
        }

        .bg-lg {
            background: rgb(8, 26, 171);
            background: linear-gradient(90deg, rgba(8, 26, 171, 1) 37%, rgba(34, 58, 241, 0.9514005431274072) 93%);
        }

        .bg-cpl {}

        .bg-ctc {
            background: rgb(104, 159, 56);
            background: linear-gradient(90deg, rgba(104, 159, 56, 1) 15%, rgba(67, 143, 0, 0.9457983022310487) 93%);
        }

        .bg-tc {
            background: rgb(240, 68, 124);
            background: linear-gradient(90deg, rgba(240, 68, 124, 1) 15%, rgba(161, 5, 56, 1) 93%);
        }

        .bg-pb {
            background: rgb(67, 212, 65);
            background: linear-gradient(90deg, rgba(67, 212, 65, 1) 15%, rgba(7, 133, 12, 1) 93%);
        }*/
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        var options = {
            series: [{
                name: 'Profit',
                data: {!! json_encode($profitability['y']) !!},
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
                    formatter: function(y) {
                        return y.toFixed(0) + "%";
                    }
                }
            },
            xaxis: {
                type: 'datetime',
                categories: {!! json_encode($profitability['x']) !!},
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

        $(document).ready(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange #date-duration').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));

                console.log('start', start.format("YYYY-MM-DD"))
                console.log('end', end.format("YYYY-MM-DD"))
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment()
                        .subtract(1, 'year').endOf('year')
                    ]
                }
            }, cb);

            cb(start, end);
        });
    </script>
@endpush

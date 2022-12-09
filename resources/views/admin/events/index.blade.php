@extends('layouts.app')

@section('heading', 'Events')
@section('content')
    <div class="my-3 flex h-8 items-center justify-between">
        <h2
            class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
        >
            <label class="flex items-center space-x-2">
                Events
            </label>
        </h2>
    </div>

    <div class="table-wrapper">
        <div class="card light bordered card-no-padding m-3 p-3 m-sm-5 p-sm-5">
            <div class="card-body">
                <div class="table-responsive  table-has-actions   table-has-filter ">
                    <div class="justify-content-between dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div>
                            <span class="flex justify-end ">
                                <a
                                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    data-action="create"
                                    href="{{ route('admin.events.create') }}">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </span>
                        </div>
{{--                        <div class="dataTables_processing panel panel-default" style="display: none;"></div>--}}
{{--                        <table class="table table-striped table-hover vertical-middle dataTable no-footer dtr-inline"--}}
{{--                               role="grid">--}}
{{--                            <thead>--}}
{{--                            <tr class="text-center   ">--}}
{{--                                <th></th>--}}
{{--                                <th title="Change" class="text-center">Name</th>--}}
{{--                                <th title="Operations" class="text-center" >Operations</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody id="myTable" class="sort_menu">--}}
{{--                            --}}{{--                            @dd($habit)--}}
{{--                            @forelse($habit as $key=>$single_habit)--}}
{{--                                <tr role="row" class="odd text-center" data-id="{{$single_habit->id}}">--}}
{{--                                    <td > <span class="handle"></span></td>--}}
{{--                                    <td class=" column-key-name">{{ $single_habit->name }}</td>--}}
{{--                                    <td class="flex justify-between">--}}
{{--                                        <a--}}
{{--                                            class="btn space-x-2 bg-warning font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"--}}
{{--                                            href="{{ route('admin.habits.edit', $single_habit->id) }}">--}}
{{--                                            Edit--}}
{{--                                        </a>--}}
{{--                                        <div class="d-inline">--}}
{{--                                            <form--}}
{{--                                                class="d-inline"--}}
{{--                                                action="{{ route('admin.habits.destroy', [$single_habit->id]) }}"--}}
{{--                                                method="POST">--}}
{{--                                                @csrf--}}
{{--                                                <input name="_method" type="hidden" value="DELETE">--}}
{{--                                                <button--}}
{{--                                                    class="btn space-x-2 bg-info font-medium text-white hover:bg-danger-focus focus:bg-danger-focus active:bg-danger-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"--}}
{{--                                                >--}}
{{--                                                    <span>Delete</span>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}

{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @empty--}}
{{--                                <td colspan="12 " class="text-center">No record found</td>--}}
{{--                            @endforelse--}}

{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                --}}{{--                <div class="justify-content-center w-100">--}}
{{--                --}}{{--                    {!! $habit->render() !!}--}}
{{--                --}}{{--                </div>--}}
            </div>
        </div>
    </div>


@endsection

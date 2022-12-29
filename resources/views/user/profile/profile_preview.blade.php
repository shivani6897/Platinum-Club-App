@extends('layouts.app')

@section('heading', 'Profile')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="#"
            >
                Profile Preview
            </a>
        </li>
    </ul>
@endsection
@section('content')
{{--    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">--}}
        <div class="card mt-3">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <form method="Post" action="{{ route('user.profile.update') }}">
                    {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">

                        <table class="w-full text-left">
                            <tbody>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Name:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{$userdetails->name}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Email:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{$userdetails->email}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Phone Number:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{$userdetails->phone_no}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Name:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_name) ? $userdetails->business_name : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Type:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{$userdetails->business_id? $userdetails->business_id : '-' }}</strong>
                                    </td>
                                </tr>

                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Website:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_website) ? $userdetails->business_website : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Address:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_address) ? $userdetails->business_address : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business City:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_city) ? $userdetails->business_city : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Pincode:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_pincode) ? $userdetails->business_pincode : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Sate/Prov/Region
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_state) ? $userdetails->business_state : '-'}}</strong>
                                    </td>
                                </tr>

                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Business Country:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_country) ? $userdetails->business_country : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Time Zone:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->business_timezone) ? $userdetails->business_timezone : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Authorized User Name:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->auth_name) ? $userdetails->auth_name : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Authorized User Email:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->auth_email) ? $userdetails->auth_email : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Authorized User Number:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{isset($userdetails->auth_phone_no) ? $userdetails->auth_phone_no : '-'}}</strong>
                                    </td>
                                </tr>

                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        Authorized User Job Position:
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <strong>{{$userdetails->job_position_id ? $userdetails->job_position_id : '-'}}</strong>
                                    </td>
                                </tr>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap px-4 py-3"  colspan="2">
                                        <button
                                            type="submit"
                                            class="btn space-x-2 float-right  bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                        >
                                            <span>Save</span>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

@endsection
@push('scripts')

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
@endpush

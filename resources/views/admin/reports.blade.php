@extends('layouts.admin')

@section('meta')
    <title>Reports | Mortgage Auditor</title>
    <meta name="description" content="Workday Reports">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <h2 class="page-title">
                {{ __("Reports") }}
            </h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table width="100%" class="table table-striped" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>{{ __('Report Name') }}</th>
                        <th>{{ __('Date Accessed') }}</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="{{ url('admin/reports/employee-list') }}"><i class="fas fa-users"></i> {{ __('Users Report') }}</a></td>
                    <td>
                        @isset($lastviews)
                            @foreach ($lastviews as $views)
                                @if($views->report_id == 1)
                                    {{ $views->last_viewed }}
                                @endif
                            @endforeach
                        @endisset
                    </td>
                </tr>
                
                
               
                
                <tr>
                    <td><a href="{{ url('admin/reports/user-accounts') }}"><i class="fas fa-address-book"></i> {{ __('Default Reports') }}</a></td>
                    <td>
                        @isset($lastviews)
                            @foreach ($lastviews as $views)
                                @if($views->report_id == 6)
                                    {{ $views->last_viewed }}
                                @endif
                            @endforeach
                        @endisset
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/initiate-datatables.js') }}"></script> 
@endsection
@extends('layouts.admin')

@section('meta')
    <title>Default Reports | Mortgage Auditor</title>
    <meta name="description" content="User Accounts">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 page-header">
                <h2 class="page-title">
                    {{ __('Default Reports') }}

                    <a href="{{ url('export/report/accounts') }}" class="btn btn-outline-secondary btn-sm mr-2 float-right">
                        <i class="fas fa-download"></i><span class="button-with-icon">{{ __('Export') }}</span>
                    </a>

                    <a href="{{ url('admin/reports') }}" class="btn btn-outline-primary btn-sm mr-2 float-right">
                        <i class="fas fa-arrow-left"></i><span class="button-with-icon">{{ __('Back') }}</span>
                    </a>
                </h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table width="100%" class="table" id="dataTables-example" data-order='[[ 0, "asc" ]]'>
                    <thead>
                        <tr>
                            <th>{{ __('Customer ID') }}</th>
                            <th>{{ __('Prediction') }}</th>
                            <th>{{ __('Amount Recommended') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($users)
                            @foreach ($users as $data)
                                <tr>
                                    <td>{{ $data->employee_id }}</td>
                                    <td>
                                        @if ($data->churn_status === 1)
                                            This employee is highly likely to leave
                                        @else
                                            This employee is not likely to leave
                                        @endif
                                    </td>
                                    <td>Ksh. 50000</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->updated_at }}</td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/initiate-datatables-with-search.js') }}"></script>
@endsection

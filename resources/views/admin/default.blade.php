@extends('layouts.admin')

@section('meta')
    <title>Mortgage Default Prediction </title>
    <meta name="description" content="Attendance">
@endsection

@section('content')
 
<div class="container ">
    <div class="row">
        <div class="col-md-12 page-header">
            <h2 class="page-title">
                {{ __("Mortgage Default Prediction") }}

                <a href="{{ url('/admin/default/manual-entry') }}" class="btn btn-outline-primary btn-sm float-right">
                    <i class="fas fa-plus"></i><span class="button-with-icon">{{ __("Predict New Default") }}</span>
                </a>
               
            </h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            

            <table width="100%" class="table custom-table-ui" data-order='[[ 0, "desc" ]]' >
                <thead>
                    <tr>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Customer ID') }}</th>
                        <th>{{ __('Customer Name') }}</th>
                        <th>{{ __('Predicted Default') }} ({{ __("Default") }}/{{ __("Not Default") }})</th>
                        <th>{{ __('Recommended Amount(KES)') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($defaults)
                    @foreach ($defaults as $data)
                    <tr>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->employee_id }}</td>
                        <td>Dan Okola</td>
                        <td>
                           
                            @php 
                                if($data->churn_status == 1) {
                                   echo "Customer will default on Mortgage";
                                } else {
                                  echo "Customer will not default on Mortgage"; 
                                }
                            @endphp
                        </td>
                        <td>5,000,000</td>
                        <td class="text-right">
                            <a href="{{ url('/admin/default/delete') }}/{{ $data->id }}" class="btn btn-outline-secondary btn-sm btn-rounded"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
            {{-- <small class="text-muted">{{ __("Only 250 recent records will be displayed use Date range filter to get more records") }}</small> --}}
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/initiate-datatables.js') }}"></script> 
    <script src="{{ asset('/assets/js/initiate-toast.js') }}"></script>
@endsection
@extends('layouts.admin')

@section('meta')
    <title>Mortgage Auditor </title>
    <meta name="description">
@endsection

@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <h2 class="page-title">
                {{ __("New Mortgage Default Prediction") }}

                <a href="{{ url('/admin/attrition') }}" class="btn btn-outline-primary btn-sm float-right">
                    <i class="fas fa-arrow-left"></i><span class="button-with-icon">{{ __("Return") }}</span>
                </a>
            </h2>
        </div>
    </div>
 
 
    <div class="card">
        @if(Session::has('success'))

                   <div class="alert alert-success">
                    {{ Session::get( 'success' ) }}
                   </div>
                   @endif

                    @if(Session::has('error'))
                   <div class="alert alert-danger">
                    {{ Session::get( 'error' ) }}
                   </div>
                   @endif
        
        <form action="{{ url('admin/attrition/add-entry') }}" method="post" class="needs-validation" autocomplete="off" novalidate accept-charset="utf-8">
            @csrf
            {{-- <div class="card-header"></div> --}}
            <div class="card-body">
                <div class="form-group">
                  <label for="name">{{ __("Customer") }}</label>
                  <select name="name" class="form-control" required>
                    <option value="" disabled selected>Choose...</option>
                    @isset($employee)
                    @foreach ($employee as $data)
                        <option value="{{ $data->id }}" data-reference="{{ $data->id }}">{{ $data->lastname }}, {{ $data->firstname }}</option>
                    @endforeach
                    @endisset
                  </select>
                </div>
                <div class="form-group">
                    <label for="age">{{ __("Loan") }} <small class="text-muted">(Amount of loan approved)</small></label>
                    <input type="text" name="loan" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("MORTDUE") }}<small class="text-muted">(Amount due on the existing mortgage)</small> </label>
                    <input type="text" name="mortdue" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("VALUE") }}<small class="text-muted">(Current value of the property)</small> </label>
                    <input type="text" name="value" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("REASON") }}<small class="text-muted">(Reason for the loan reques)</small> </label>
                    <input type="text" name="reason" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("JOB") }}<small class="text-muted">(Amount of loan approved)</small> </label>
                    <input type="text" name="job" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("Years at present Job") }}</label>
                    <input type="text" name="years_at_present_job" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("DEROG") }}<small class="text-muted">(Number of major derogatory reports)</small> </label>
                    <input type="text" name="derog" value="" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="credits">{{ __("DELINQ") }} <small class="text-muted">(Number of delinquent credit lines)</small></label>
                    <input type="text" name="delinq" value="" class="form-control text-uppercase" required>
                </div>
       
            </div>
            <div class="text-right mr-3">
                {{-- <input type="hidden" value="" name="reference"> --}}
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i><span class="button-with-icon">{{ __("Predict Mortgage Default") }}</span>
                </button>
                <a href="{{ url('/admin/attrition') }}" class="btn btn-secondary">
                    <i class="fas fa-times-circle"></i><span class="button-with-icon">{{ __("Cancel Prediction") }}</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
 

@section('scripts')
    <script src="{{ asset('/assets/js/validate-form.js') }}"></script>
    <script src="{{ asset('/assets/js/get-employee-id.js') }}"></script>
    <script src="{{ asset('/assets/js/initiate-toast.js') }}"></script>
@endsection
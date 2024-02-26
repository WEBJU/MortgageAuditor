@extends('layouts.admin')

@section('meta')
    <title>Mortgage Auditor </title>
    <meta name="description">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <h2 class="page-title ml-4">
                {{ __("Perform Batch Predictions") }}

                <a href="{{ url('/admin/default') }}" class="btn btn-outline-primary btn-sm float-right">
                    <i class="fas fa-arrow-left"></i><span class="button-with-icon">{{ __("Go Back") }}</span>
                </a>
            </h2>
        </div>
    </div>
 

    <div class="card m-4">
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
        
        <form action="{{ url('admin/default/process_dataset') }}" method="post" class="needs-validation" autocomplete="off" novalidate accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <div class="card-header"></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="age">{{ __("Name") }} <small class="text-muted"></small></label>
                    <input type="text" name="title" value="" class="form-control" placeholder="Give your dataset a name" required>
                </div>
                <div class="form-group">
                 
                  <div class="mb-3">
                    <label for="name">{{ __("Mortgage Data") }}</label><br>
                    <input name="csvFile" class="" type="file" id="formFile">
                  </div>
                </div>
               
              
                
            </div>
            <div class="card-footer text-right">
                <input type="hidden" value="" name="reference">
                
                <button type="submit" class="btn btn-primary">
                    {{ __("Start Predicting") }}
                </button>
                
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
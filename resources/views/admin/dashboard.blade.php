@extends('layouts.admin')

@section('meta')
    <title>Dashboard | Mortgage Auditor</title>
    <meta name="description" content="Dashboard">
@endsection

@section('content')

<div class="container">
    <div class="jumbotron shadow-sm" style="background: #2D3A5E; color:#fff">
      <h1 class="display-4">{{ __("Welcome back") }}, <span class="text-capitalize">DAN</span>!</h1>
      <p class="lead">Mortgage Auditor {{ __("dashboard Quick Metrics") }}</p>
      {{-- <button class="btn btn-outline-primary" role="button">{{ __("See the key stats below") }}</button> --}}
      <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card bg-light-green border-1 shadow-sm">
                <div class="card-body text-dark">
                    <p class="mb-0">{{ __("Total Customers") }}</p>
                    <h3 class="mt-3 font-weight-bolder">{{ $total_employees }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-light-blue border-0 shadow-sm">
                <div class="card-body text-dark">
                    <p class="mb-0">{{ __("Total  Predictions") }}</p>
                    <h3 class="mt-3 font-weight-bolder">{{ $total_attendances }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-light-gray border-0 shadow-sm">
                <div class="card-body text-dark">
                    <p class="mb-0">{{ __("Mortgage Predictions") }}</p>
                    <h3 class="mt-3 font-weight-bolder">1</h3>
                </div>
            </div>
        </div>
        <
    </div>
    </div>

   
</div>
@endsection


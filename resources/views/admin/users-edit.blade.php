@extends('layouts.admin')

@section('meta')
    <title>Edit User | Workday Time Clock</title>
    <meta name="description" content="Workday Edit User">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <h2 class="page-title">
                {{ __("Edit User") }}

                <a href="{{ url('/admin/users') }}" class="btn btn-outline-primary btn-sm float-right">
                    <i class="fas fa-arrow-left"></i><span class="button-with-icon">{{ __("Return") }}</span>
                </a>
            </h2>
        </div>
    </div>

    <div class="card">
        <form action="{{ url('admin/users/update') }}" method="post" class="needs-validation" autocomplete="off" novalidate accept-charset="utf-8">
            @csrf
            <div class="card-header"></div>
            <div class="card-body">
                <div class="form-group">
                  <label for="name">{{ __("Employee") }}</label>
                  <input type="text" name="name" value="@isset($user->name){{ $user->name }}@endisset" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="email">{{ __("Email") }}</label>
                    <input type="email" name="email" value="@isset($user->email){{ $user->email }}@endisset" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="dateto">{{ __("Account Type") }}</label>
                    <div class="custom-control custom-radio">
                      <input type="radio" value="1" name="acc_type" id="acc_type1" class="custom-control-input" required @isset($user->acc_type) @if($user->acc_type == 1) checked @endif @endisset>
                      <label class="custom-control-label" for="acc_type1">{{ __("Employee") }}</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" value="2" name="acc_type" id="acc_type2" class="custom-control-input" required @isset($user->acc_type) @if($user->acc_type == 2) checked @endif @endisset>
                      <label class="custom-control-label" for="acc_type2">{{ __("Admin") }}</label>
                    </div>
                </div>

                <div class="form-group">
                  <label for="role_id">{{ __("Role") }}</label>
                  <select name="role_id" class="custom-select" required>
                    <option value="" disabled selected>Choose...</option>
                    @isset($roles)
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->role_name }}</option>
                        @endforeach
                    @endisset
                  </select>
                </div>

                <div class="form-group">
                  <label for="status">{{ __("Status") }}</label>
                  <select name="status" class="custom-select text-uppercase" required>
                    <option value="" disabled selected>Choose...</option>
                    <option value="1" @isset($user->status) @if($user->status == 1) selected @endif @endisset>{{ __("Enabled") }}</option>
                    <option value="0" @isset($user->status) @if($user->status == 0) selected @endif @endisset>{{ __("Disabled") }}</option>
                  </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">{{ __("Password") }}</label>
                        <input type="password" name="password" value="" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">{{ __("Confirm Password") }}</label>
                        <input type="password" name="password_confirmation" value="" class="form-control">
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <input type="hidden" value="@isset($user->id){{ $user->id }}@endisset" name="ref">
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i><span class="button-with-icon">{{ __("Save") }}</span>
                </button>
                <a href="{{ url('/admin/users') }}" class="btn btn-secondary">
                    <i class="fas fa-times-circle"></i><span class="button-with-icon">{{ __("Cancel") }}</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/js/validate-form.js') }}"></script>
    <script src="{{ asset('/assets/js/get-user-email.js') }}"></script>
@endsection
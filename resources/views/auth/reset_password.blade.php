@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Password Expired') }}</div>
                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger alert-square">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-square">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-info alert-square">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('resetPassword') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="current_password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control"
                                           name="current_password" required>

                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                           required>

                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation" class="col-md-4 control-label">Confirm New
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control"
                                           name="new_password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header">New Employee</div>

                <div class="card-body">
                    <a href="{{ route("home") }}" class="btn btn-info mb-2">Back to home</a>
                    <form action="{{ route("employee.store") }}" method="POST">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Company</label>
                            <select name="company_id" id="" class="form-control">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <input type="submit" name="submit" class="btn btn-success" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                <div class="card-header">View Company</div>

                <div class="card-body">
                    <a href="{{ route("home") }}" class="btn btn-info mb-2">Back to list</a>
                    <a href="{{ route("employee.create") }}" class="btn btn-primary mb-2">Add Employee</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $company->name }}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>{{ $company->website }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $company->email }}</td>
                                </tr>
                                <tr>
                                    <td>Logo</td>
                                    <td>
                                        <img src="{{ url('storage/'.$company->logo) }}" alt="Logo" class="img-responsive" style="width: 100px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">Employee List</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="{{ route("employee.edit",[$employee->id]) }}" class="btn btn-info">Edit</a>
                                        <a onclick="event.preventDefault();
                                        document.getElementById('delete-employee-{{ $employee->id }}').submit();" href="{{ route("employee.delete",[$employee->id]) }}" class="btn btn-danger">Delete</a>

                                        <form id="delete-employee-{{ $employee->id }}" action="{{ route("employee.delete",[$employee->id]) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $employees->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

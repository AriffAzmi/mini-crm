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
                <div class="card-header">Companies</div>

                <div class="card-body">
                    <a href="{{ route("company.create") }}" class="btn btn-success">Create new company</a>
                    <a href="{{ route("employee.create") }}" class="btn btn-success">Create new employee</a>
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <table class="table table-bordered mt-2">
                        <thead>
                            <th>Name</th>
                            <th>Website</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if ($companies->count() > 0)
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ strlen($company->website) > 0 ? $company->website : "-" }}</td>
                                        <td>{{ strlen($company->email) > 0 ? $company->email : "-" }}</td>
                                        <td>
                                            <a href="{{ route("company.show",[$company->id]) }}" class="btn btn-primary">View</a>
                                            <a href="{{ route("company.edit",[$company->id]) }}" class="btn btn-info">Edit</a>
                                            <a onclick="event.preventDefault();
                                            document.getElementById('delete-company-{{ $company->id }}').submit();" href="{{ route("company.delete",[$company->id]) }}" class="btn btn-danger">Delete</a>
                                            <form id="delete-company-{{ $company->id }}" action="{{ route("company.delete",[$company->id]) }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    No company record yet.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        
                    </table>
                    {{-- <div class="d-flex justify-content-center"> --}}
                    {{-- </div> --}}
                    {{-- <ul class="pagination">
                        @for($i=1; $i <= $companies->lastPage(); $i++)
                        @if ($companies->currentPage() == $i)
                            <li><a href="#" class="btn btn-sm btn-primary ml-1">{{ $i }}</a></li>
                        @else
                            @if ($companies->currentPage() == 1)
                                <li><a href="{{ $companies->firstPage() }}" class="btn btn-sm btn-primary ml-1">{{ $i }}</a></li>
                            @else
                            <li><a href="{{ $companies->nextPageUrl() }}" class="btn btn-sm btn-primary ml-1">{{ $i }}</a></li>
                            @endif
                        
                        @endif
                        @endfor
                    </ul> --}}
                </div>
                {!! $companies->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>Welcome {{ auth()->user()->name }}, You're Information:</h4>

                        <table class="table table-bordered table-hover">
                            <thead class="bg-secondary text-white">
                            <tr>
                                <td>You're Email</td>
                                <td>You're National Code</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ auth()->user()->email }}</td>
                                <td>{{ auth()->user()->national_code }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-6  mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Import Users</strong>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('import_users_to_db') }}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Select An Excel File: </label>
                                                <input type="file" name="excel_file" class="form-control-file"
                                                       accept=".xlsx,.xls">
                                            </div>
                                            <input type="submit" value="Submit" class="btn btn-success">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Export Users</strong>
                                    </div>
                                    <div class="card-body" style="padding: 4em 1em;">
                                        <form action="{{ route('export_users_to_excel') }}" method="post">
                                            @csrf
                                            <input type="submit" value="Download File" class="btn btn-primary btn-block">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

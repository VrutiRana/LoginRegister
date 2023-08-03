@extends('layout')
@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Document List
                            <a class="btn btn-success" style="float: right" href="{{route('product.add')}}" name="add">Add</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                            @if(session('success'))
                                <p class="alert alert-success">{{session('success')}}</p>
                            @endif
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td> Document </td>
                                            <td> Action </td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

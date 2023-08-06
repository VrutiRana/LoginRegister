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
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{session('success')}}
                                </div>
                            @endif
                                <table class="table table-bordered">

                                        <tr>
                                            <th> Document </th>
                                            <th> Action </th>
                                        </tr>
                                    <tbody>
                                    @if($alldocument->isEmpty())
                                        <tr>
                                            <td>No data Found</td>
                                        </tr>
                                    @else
                                        @foreach($alldocument as $doc)
                                            <tr>
                                                <td>{{$doc->terms_condition}}</td>
                                                <td><a href="{{route('product.download-document-ajax',$doc->id)}}"><i class="fa fa-download"></i> </a> </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

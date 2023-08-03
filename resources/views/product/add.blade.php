@extends('layout')
@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login
                            <a href="{{route('product.list')}}" style="float: right" class="btn btn-primary">
                                List
                            </a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                            @if(session('success'))
                                <p class="alert alert-success">{{session('success')}}</p>
                            @endif
                            <form action="{{ route('product.list') }}" enctype="multipart/form-data" method="POST" name="product" id="product">
                                @csrf

                                <div class="form-group row">
                                    <label for="termscondition" class="col-md-4 col-form-label text-md-right">Document</label>
                                    <div class="col-md-6">
                                        <span class="">
                                                <input type="file" name="termscondition"  class="btn btn-success" id="termscondition"
                                                       accept=".jpg,.png,.pdf" hidden="">
                                                <label style="background-color: rgb(37, 55, 139);color: #fff !important;border-radius: 0.3rem;padding: 3px 7px;cursor: pointer;" id="upload_btn" for="termscondition">Browse</label>
                                            </span>
                                        <div>
                                            <span id="filenamedoc" class="ms-2"></span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script type="text/javascript">

        $(document).on('change', '#termscondition', function(e) {
                console.log('123');
                var input = $(this);
                var inputFiles = this.files;
                let file = inputFiles[0];
                let size = Math.round((file.size / 1024))
                if (size > 3000) {
                    swal({
                        icon: 'error',
                        title: '',
                        text: 'File size should be less than 3MB',
                    })
                    return false;
                }
                let fileName = file.name;
                $('#filenamedoc').html(fileName);
                valid = false;
            });

    </script>
@endsection


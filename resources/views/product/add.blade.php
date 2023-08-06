@extends('layout')
@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add Document
                            <a href="{{route('product.list')}}" style="float: right" class="btn btn-primary">
                                List
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" role="alert" style="display: none">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                            <form action="{{ route('product.list') }}" enctype="multipart/form-data" method="POST" name="product" id="product">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="termscondition" class="col-md-4 col-form-label text-md-right">Document</label>
                                        <span class="">
                                                <input type="file" name="termscondition"  class="btn btn-success" id="termscondition"
                                                       accept=".jpg,.png,.pdf" hidden="">
                                                <label style="background-color: rgb(37, 55, 139);color: #fff !important;border-radius: 0.3rem;padding: 3px 7px;cursor: pointer;" id="upload_btn" for="termscondition">Browse</label>
                                            </span>
                                            <span id="filenamedoc" class="ms-2"></span>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">

        $(document).on('change', '#termscondition', function(e) {
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
                valid = false;
                let fileName = file.name;
                $('#filenamedoc').html(fileName);
                var formData = new FormData($('#product')[0]);
                console.log(formData);
                $.ajax({
                    url: "{{ route('product.upload-document-ajax') }}",
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (successData) {
                        $('#filenamedoc').html(successData.name);
                        $('.alert-success').show(function(){
                            $(this).html(successData.msg);
                        });
                       window.setTimeout(function(){
                            window.location.href = '{{route('product.list')}}';
                        }, 5000);

                    },
                    error: function () {
                        $('.alert-danger').show(function(){
                            $(this).html(successData.msg);
                        });
                        window.setTimeout(function(){
                            window.location.href = '{{route('product.list')}}';
                        }, 5000);
                    }
                });
            });

    </script>
@endsection


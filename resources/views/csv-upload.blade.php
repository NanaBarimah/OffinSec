@extends('layouts.main-layout', ['page_title' => 'Upload CSV'])
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="jumbotron p-4">
                <h1 class="display-4">Upload CSV </h1>
                <p class="lead">Upload guard data in the form of a CSV file. Be very sure the file you are uploading follows the specified structure.</p>
                <hr class="my-4">
                <form method ="post" action ="#" type="multipart/formdata" id="csvform">
                    <input type="file" name="csvfile" id="csvfile"/>
                    <button type="submit" class="btn btn-custom">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#csvform').on('submit', function(e){
            e.preventDefault();
            var formdata = new FormData(this);

            btn = $(this).find('[type="submit"]');
            initial = btn.html();
            applyLoading(btn);

            $.ajax({
                url: '/api/guards/upload-csv',
                method: 'post', 
                data: formdata,
                contentType: false, 
                processData: false,
                success: function(data){
                    removeLoading(btn, initial);
                    console.log(data);
                },
                error:function(err){
                    removeLoading(btn, initial);
                    console.log(err);
                }
            });
        })
    </script>
@endsection
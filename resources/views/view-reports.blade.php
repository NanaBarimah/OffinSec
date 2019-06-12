@extends('layouts.main-layout', ['page_title' => 'Reports'])

@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <button type="button" class="btn btn-custom w-md waves-effect waves-light float-right">New Report</button>
            <h4 class="header-title m-b-30">Generated Reports</h4>
            
            <div class="row">
                @foreach($reports as $report)
                <div class="col-lg-3 col-xl-2" title="{{$report->template}}">
                    <div class="file-man-box">
                        <small>{{$report->client->name}}</small>
                        <div class="file-img-box">
                            <img src="{{asset('assets/images/pdf.svg')}}" alt="icon">
                        </div>
                        <a href="/download/{{$report->fileName}}" class="file-download"><i class="mdi mdi-download text-primary"></i> </a>
                        <div class="file-man-title">
                            <h5 class="mb-0 text-overflow">{{$report->template}}</h5>
                            <p class="mb-0"><small>{{Carbon\Carbon::parse($report->created_at)->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                {{$reports->links()}}
            </div>
        </div>
    </div><!-- end col -->
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    table = $('table').DataTable();
</script>
@endsection
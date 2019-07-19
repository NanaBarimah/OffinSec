@extends('layouts.main-layout', ['page_title' => 'View Attendance'])
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card-box">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="nav-item">
                            <a href="#time-in" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                 Check In
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#time-out" data-toggle="tab" aria-expanded="true" class="nav-link">
                                 Check Out
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#random" data-toggle="tab" aria-expanded="true" class="nav-link">
                                 Random Check
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="time-in">
                            <div class="col-sm-12">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Shift</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    @isset($attendances[1])
                                        @foreach($attendances[1] as $attendance)
                                            <tr>
                                                <td>{{$attendance->owner_guard->firstname.' '.$attendance->owner_guard->lastname}}</td>
                                                <td>{{$attendance->owner_guard->duty_rosters[0] == null ? N/A : $attendance->owner_guard->duty_rosters[0]->pivot->shift_type_name}}</td>
                                                <td>{{date('jS F, Y', strtotime($attendance->date_time))}}</td>
                                                <td>{{date('H:i:s', strtotime($attendance->date_time))}}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="time-out">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Shift</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        @isset($attendances[0])
                                            @foreach($attendances[0] as $attendance)
                                                <tr>
                                                    <td>{{$attendance->owner_guard->firstname.' '.$attendance->owner_guard->lastname}}</td>
                                                    <td>{{$attendance->owner_guard->duty_rosters[0] == null ? N/A : $attendance->owner_guard->duty_rosters[0]->pivot->shift_type_name}}</td>
                                                    <td>{{date('jS F, Y', strtotime($attendance->date_time))}}</td>
                                                    <td>{{date('H:i:s', strtotime($attendance->date_time))}}</td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="random">
                            <div class="col-sm-12">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Shift</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    @isset($attendances[2])
                                        @foreach($attendances[2] as $attendance)
                                            <tr>
                                                <td>{{$attendance->owner_guard->firstname.' '.$attendance->owner_guard->lastname}}</td>
                                                <td>{{$attendance->owner_guard->duty_rosters[0] == null ? N/A : $attendance->owner_guard->duty_rosters[0]->pivot->shift_type_name}}</td>
                                                <td>{{date('jS F, Y', strtotime($attendance->date_time))}}</td>
                                                <td>{{date('H:i:s', strtotime($attendance->date_time))}}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </table>
                            </div>
                        </div>
                </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
    <!-- end col-12 -->
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script>
    $(".table").DataTable({
        "bLengthChange": false,
        dom: 'Blfrtip',
        buttons: [ 
            {
                extend: 'excelHtml5',
                title: name
            },
            {
                extend: 'pdfHtml5',
                title: name
            }]
    });
</script>
@endsection
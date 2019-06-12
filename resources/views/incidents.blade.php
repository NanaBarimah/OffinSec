@extends('layouts.main-layout', ['page_title' => 'Incidents'])
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row incidents">
    <div class="col-12">
        <div class="">
            <table class="table table-striped table-hover table-borderd">
                <thead>
                    <th>Date of Incident</th>
                    <th>Date Reported</th>
                    <th>Site</th>
                    <th>Incident</th>
                    <th>Action Taken</th>
                </thead>
                <tbody>
                    @foreach($incidents as $incident)
                    <tr>
                        <td>{{Carbon/Carbon::parse($incident->date)->format('jS F Y')}}</td>
                        <td>{{Carbon/Carbon::parse($incident->created_at)->format('jS F Y')}}</td>
                        <td>{{$incident->site->name}}</td>
                        <td>{{$incident->incident}}</td>
                        <td>{{$incident->action_taken}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script>
    var name = " Incidents " + '<?php echo date('Y-m-d'); ?>';
    var table = $('.table').DataTable({
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
            }, 'copy', 'print' ]
    });
</script>
@endsection
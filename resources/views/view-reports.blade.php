@extends('layouts.main-layout', ['page_title' => 'Reports'])

@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">


                            <table class="table table-hover m-0 permissions-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>Created At</th>
                                    <th>Client Name</th>
                                    <th>File Link</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td><b>#{{$report->id}}</b></td>
                                    <td>
                                        {{$report->created_at}}
                                    </td>

                                    <td>
                                        {{$report->client->name}}
                                    </td>

                                    <td>
                                        <a href="{{$report->template}}">{{$report->template}}</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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
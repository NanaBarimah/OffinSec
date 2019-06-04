@extends('layouts.main-layout', ['page_title' => 'Client Salaries'])
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
        <div class="row">
            <div class="col-xl-4 col">
                <!-- Personal-Information -->
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-20">Tools</h4>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <label for="apply_to_all">Apply Wage To All Guards</label>
                            <input class="form-control" type="number" id="apply_to_all"/>
                        </div>
                        <div class="text-right mt-2">
                            <button type="button" id="apply" class="btn btn-custom">Apply</button>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="reset">Reset All Guard Salaries</label>
                            <p>Be sure you want to reset salaries before you take this action.</p>
                            <div class="text-right">
                                <button type="button" id="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


            <div class="col-xl-8">
                <div class="card-box">
                    <h4 class="header-title mb-3">Guards List</h4>

                    <table class="datatable table table-striped" id="datatable">
                        <thead>
                            <th>Guard Name</th>
                            <th>Site Name</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($client->sites as $site)
                                @foreach($site->duty_roster->guards as $guard)
                                <tr>
                                    <td>{{$guard->firstname.' '.$guard->lastname}}</td>
                                    <td>{{$site->name}}</td>
                                    <td>0</td>
                                    <td><a href="javascript:void(0)"><i class="dripicons-pencil"></i></a></td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end col -->

        </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    var table = $('#datatable').DataTable();
</script>
@endsection
@extends('layouts.main-layout', ['page_title' => 'Permissions'])

@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    @php
        $sorted_permissions = collect($permissions)->groupBy('approval');
    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Manage permissions</h4>

                            <div class="text-center mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-custom bg-custom text-white">
                                            <i class="fi-tag"></i>
                                            <h3 class="m-b-10">{{$permissions->count()}}</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Total permissions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white">
                                            <i class="fi-archive"></i>
                                            <h3 class="m-b-10">{{isset($sorted_permissions['2']) ? $sorted_permissions['2']->count() : 0}}</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Pending permissions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white">
                                            <i class="fi-help"></i>
                                            <h3 class="m-b-10">{{isset($sorted_permissions['1']) ? $sorted_permissions['1']->count() : 0}}</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Accepted permissions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white">
                                            <i class="fi-delete"></i>
                                            <h3 class="m-b-10">{{isset($sorted_permissions['0']) ? $sorted_permissions['0']->count() : 0}}</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Declined permissions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <table class="table table-hover m-0 permissions-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>Requested By</th>
                                    <th>Reason</th>
                                    <th>Reliever</th>
                                    <th>Status</th>
                                    <th>Requested Date</th>
                                    <th>Created At</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($permissions as $permission)
                                @php
                                $permisson_date = Carbon\Carbon::parse($permission->date)
                                @endphp
                                <tr>
                                    <td><b>#{{$permission->id}}</b></td>
                                    <td>
                                        <a href="javascript: void(0);">
                                            <img src="{{$permission->owner_guard->photo == '' || $permission->owner_guard->photo == null ? asset('assets/images/avatar.jpg') : asset('assets/images/guards/'.$permission->owner_guard->photo)}}" onerror="this.src={{asset('assets/images/avatar.jpg')}}" class="rounded-circle thumb-sm" alt="friend" />
                                            <span class="ml-2">{{ucwords($permission->owner_guard->firstname.' '.$permission->owner_guard->lastname)}}</span>
                                        </a>
                                    </td>

                                    <td>
                                        {{$permission->reason}}
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);">
                                        <img src="{{$permission->relieving_guard->photo == '' || $permission->relieving_guard->photo == null ? asset('assets/images/avatar.jpg') : asset('assets/images/guards/'.$permission->relieving_guard->photo)}}" onerror="this.src={{asset('assets/images/avatar.jpg')}}" class="rounded-circle thumb-sm" alt="friend" />
                                            <span class="ml-2">{{ucwords($permission->relieving_guard->firstname.' '.$permission->relieving_guard->lastname)}}</span>
                                        </a>
                                    </td>

                                    <td id="status-badge">
                                        @if($permission->approval == 2)
                                            <span class="badge badge-primary">Pending</span>
                                        @elseif($permission->approval == 1)
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($permission->approval == 0)
                                            <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$permisson_date->format('Y-m-d')}}
                                    </td>

                                    <td>
                                        {{Carbon\Carbon::parse($permission->created_at)->diffForHumans()}}
                                    </td>

                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm {{$permisson_date->isPast() ? 'disabled' : ''}}" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript: void(0);" onclick="changeStatus(1, {{$permission->id}}, this)"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>Approve</a>
                                                <a class="dropdown-item" href="javascript: void(0);" onclick="changeStatus(0, {{$permission->id}}, this)"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Reject</a>
                                            </div>
                                        </div>
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

    function changeStatus(status, permission, element){
        el = $(element);
        status_badge = el.closest('tr').find('#status-badge');

        temp = el.html();
        status_badge_temp = status_badge.html();

        status_badge.html('<span class="badge badge-light">Loading</span>');
        el.prop('disabled', true);

        $.ajax({
            url: '/api/permission/approval',
            method: 'post',
            data: 'permission_id='+permission+'&approval='+status,
            success: function(data){
                el.prop('disabled', false);
                el.html(temp);

                if(status == 1){
                   table.cell(status_badge).data('<span class="badge badge-success">Accepted</span>').draw();
                }else if(status == 0){
                   table.cell(status_badge).data('<span class="badge badge-danger">Declined</span>').draw();
                }
            },
            error: function(err){
                el.prop('disabled', false);
                status_badge.html(status_badge_temp);
            }
        });

    }
</script>
@endsection
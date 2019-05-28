@extends('layouts.main-layout', ['page_title' => 'Roster - '.$site->name]);
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
<style>
    .hideable{
        display: none;
    }

    .text-small{
        font-size: 12px;
    }

    .table tr td, .table thead th{
        font-size: 14px;
    }
</style>
@endsection
@section('content')
            @if($site->roster!=null)
            <div class="row">
                <div class="col-xl-4">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Add Guard To Roster</h4>
                        <div class="panel-body">

                            <form action="#" id="add_to_shift">
                                @csrf
                                <div class="form-group mb-4">
                                    <select class="selectpicker show-tick" data-style="btn-custom" title="Select shift to continue"
                                        id="shift_type" name="shift_type_id">
                                        @foreach($shift_types as $shift_type)
                                            <option value="{{$shift_type->id}}">{{$shift_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4 hideable">
                                    <label for="supervisor" class="col-form-label"><b>&nbsp;</b></label>
                                    <input type="text" id="autocomplete" class="form-control" placeholder="Search for guard" />
                                    <input type="hidden" name="guard_id" id="guard_id" />
                                    <input type="hidden" name="roster_id" value="{{$site->roster->id}}"/>   
                                </div>
                                <div class="form-group mb-4 hideable">
                                    <select class="selectpicker show-tick" data-style="btn-primary" title="Select days"
                                        id="days" multiple>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                        <option>Sunday</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Add To Roster</button>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                    <!-- offences forms -->



                </div>


                <div class="col-xl-8">

                    <div class="row">

                        
                        <div class="card-box col-sm-12">
                            <h4 class="header-title m-t-0 m-b-30">Duty Roster</h4>

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#monday" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        Monday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tuesday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Tuesday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#wednesday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Wednesday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#thursday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Thursday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#friday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Friday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#saturday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Saturday
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sunday" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Sunday
                                    </a>
                                </li>
                            </ul>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="monday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Monday'])
                                                    @foreach($site->roster->sorted['Monday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Monday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                            <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tuesday">
                                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Tuesday'])
                                                    @foreach($site->roster->sorted['Tuesday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Tuesday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                            <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="wednesday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Wednesday'])
                                                    @foreach($site->roster->sorted['Wednesday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Wednesday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                            <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="thursday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Thursday'])
                                                    @foreach($site->roster->sorted['Thursday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Thursday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                            <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="friday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Friday'])
                                                    @foreach($site->roster->sorted['Friday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Friday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                            <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="saturday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Saturday'])
                                                    @foreach($site->roster->sorted['Saturday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td><a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Saturday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                             <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="sunday">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>Shift</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @isset($site->roster->sorted['Sunday'])
                                                    @foreach($site->roster->sorted['Sunday'] as $guard)
                                                        <tr>
                                                            <td>{{ucwords($guard->firstname.' '.$guard->lastname)}}</td>
                                                            <td>{{$guard->pivot->shift_type_name}}</td>
                                                            <td>
                                                                <a href="javascript:void(0)" class="text-danger text-small" id="remove-{{$guard->id}}" class="remove" onclick="removeShift('{{$guard->id}}', '{{$site->id}}', 'Sunday', '{{$guard->pivot->shift_type_id}}', this)">Remove From Shift</a>
                                                                 <a href="javascript:void(0)" class="text-primary text-small ml-2" id="switch-{{$guard->id}}" onclick="switchShift('{{$guard->id}}')">Switch Shift</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>


                        </div>







                    </div>
                    <!-- end row -->


                </div>
                <!-- end col -->

            </div>
            @else
            <div class="row">
                <div class="jumbotron p-4">
                    <h1 class="display-4">No duty roster created :( </h1>
                    <p class="lead">You haven't created a duty roster for this site yet. Add one to continue</p>
                    <hr class="my-4">
                    <form method="post" id="add_roster">
                        @csrf
                        <div class="form-group">
                            <label>Roster Name: </label>
                            <input name="name" required class="form-control" placeholder="Roster Name"/>
                            <input name="site_id" type="hidden" value="{{$site->id}}"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-custom wave">Create Roster</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

             <div id="deleteShiftModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Are you sure?</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to remove this guard from this shift? This process cannot be undone.</p>
                            <div class="col-lg-12 col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-g" type="checkbox" name="complete">
                                    <label for="checkbox-g">
                                        Remove this guard entirely from the roster.
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" id="delete-shift-id"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="btn-delete-shift">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="switchShiftModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Switch Shift</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Select a new shift</p>
                            <select class="selectpicker show-tick" data-style="btn-custom" title="Select shift to continue"
                                id="shift_type" name="shift_type_id">
                                @foreach($shift_types as $shift_type)
                                    <option value="{{$shift_type->id}}">{{$shift_type->name}}</option>
                                @endforeach
                            </select>
                            <div class="col-lg-12 col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-g" type="checkbox" name="complete">
                                    <label for="checkbox-g">
                                        Apply this shift for all duty days.
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-g" type="checkbox" name="complete">
                                    <label for="checkbox-g">
                                        Apply this shift for all duty days.
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" id="delete-shift-id"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="btn-delete-shift">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script>
    var string = "{{$guards}}";
    
    string = string.replace(/&quot;/g, '"');
    string = string.replace(/&amp;/g, '&');

    var guards = JSON.parse(string);

    var formatted = $.map(guards, function (guard) { return { value: guard.firstname+' '+guard.lastname, data: { id: guard.id } }; });


    $('#autocomplete').devbridgeAutocomplete({
        lookup: formatted,
        minChars: 1,
        onSelect: function (suggestion) {
            $('#guard_id').val(suggestion.data.id);
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no guard matches your query'
    });

    $('#autocomplete').on('keydown', function () {
        $('#guard_id').val(null);
    });

    $('.table').DataTable({
        "language": {
            "emptyTable":     "No guards assigned for this day"
        }
    });

    $('#shift_type').on('change', function(){
        if($(this).val() != null || $(this).val() == ''){
            $('.hideable').css('display', 'block');
        }else{
            $('.hideable').css('display', 'none');
        }
    });

    $('#add_to_shift').on('submit', function(e){
        e.preventDefault();

        $('.text-damage').css('display', 'none');
       
        var days_error = false;
        var guard_error = false;
        var days = [];

        $(this).find('[type="hidden"]').each(function(){
            if($(this).val() == '' || $(this).val() == null){
                guard_error = true;
                $(this).closest('div').append('<p class="text-small text-damage text-danger">Select a guard</p>');
            }else{
                error = false;
            }
        });

        $(this).find('select').each(function(){
            if($(this).val() == '' || $(this).val() == null){
                days_error = true;
                $(this).closest('div').append('<p class="text-small text-damage text-danger">Select days</p>');
            }else{
                error = false;
            }
        });

        if(!days_error && !guard_error){
            var btn = $(this).find('[type="submit"]');

            var data = $(this).serialize();
            applyLoading(btn);

            $("#days :selected").each(function(){
                days.push($(this).val()); 
            });

            data+= '&days=' + JSON.stringify(days);

            $.ajax({
                url: '/api/duty_roster/add_to_roster',
                method: 'POST',
                data: data,
                success: function(data){
                    removeLoading(btn, 'Add Client');
                        if(data.error){
                            removeLoading(btn, 'Add Client');

                            $.toast({
                                text : data.message,
                                heading : 'Error',
                                position: 'top-right',
                                showHideTransition : 'slide', 
                                bgColor: '#d9534f'
                            });
                        }else{

                            $('#new_client').trigger('reset');
                            $.toast({
                                text : data.message,
                                heading : 'Done',
                                position: 'top-right',
                                bgColor : '#5cb85c',
                                showHideTransition : 'slide'
                            });

                            setTimeout(function(){
                                location.reload();
                            }, 500);
                        }
                },
                error: function(err){
                    removeLoading(btn, 'Add Client');

                    $.toast({
                        text : 'Network error',
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }
            })
        }
        

        
    });

    $('#add_roster').on('submit', function(e){
        e.preventDefault();

        data = $(this).serialize();
        btn = $(this).find('[type="submit"]');
        applyLoading(btn);


        $.ajax({
            url : '/api/duty_roster/add',
            method : 'POST',
            data : data,
            success: function(data){
                removeLoading(btn, 'Add Client');
                    if(data.error){
                        removeLoading(btn, 'Add Client');

                        $.toast({
                            text : data.message,
                            heading : 'Error',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#d9534f'
                        });
                    }else{

                        $('#new_client').trigger('reset');
                        $.toast({
                            text : data.message,
                            heading : 'Done',
                            position: 'top-right',
                            bgColor : '#5cb85c',
                            showHideTransition : 'slide'
                        });

                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    }
            },
            error: function(err){
                removeLoading(btn, 'Add Client');

                $.toast({
                    text : 'Network error',
                    heading : 'Error',
                    position: 'top-right',
                    showHideTransition : 'slide', 
                    bgColor: '#d9534f'
                });
            }
        })
    });

    function removeShift(guard_id, site_id, day, shift_type)
    {
        var temp = { 'guard_id' : guard_id, 'site_id' : site_id, 'day' : day, 'shift_type_id' : shift_type};

       $('#delete-shift-id').val(JSON.stringify(temp));

       $('#deleteShiftModal').modal('show');
    }

    $('#btn-delete-shift').on('click', function(){
        btn = $(this);
        var data = JSON.parse($('#delete-shift-id').val());

        data.complete_delete = $('#checkbox-g').prop('checked')
        
        applyLoading(btn);
        $.ajax({
            url: '/api/remove-shift/delete',
            data : data,
            method: 'DELETE',
            success: function(data){
                removeLoading(btn, 'Remove');
                    if(data.error){
                        $.toast({
                            text : data.message,
                            heading : 'Error',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#d9534f'
                        });
                    }else{
                        $.toast({
                            text : data.message,
                            heading : 'Done',
                            position: 'top-right',
                            bgColor : '#5cb85c',
                            showHideTransition : 'slide'
                        });
                        
                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    }
            },
            error: function(err){
                removeLoading(btn, 'Remove');
                $.toast({
                    text : 'Network error',
                    heading : 'Error',
                    position: 'top-right',
                    showHideTransition : 'slide', 
                    bgColor: '#d9534f'
                });
            }
        })
    });

    function switchShift(id){

    }
</script>
@endsection
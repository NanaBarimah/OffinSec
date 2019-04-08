@extends('layouts.main-layout', ['page_title' => 'Attendance'])
@section('styles')
<link href="{{asset('plugins/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet" />
<!--Bootstrap Select-->
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />

<!--Date Picker-->
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/spinkit/spinkit.css')}}" rel="stylesheet" />

<style>
    #view_attendance{
        display: none;
    }
</style>

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card-box">
            <div class="row">
                <div class="col-lg-3">
                    <a href="#" data-toggle="modal" data-target="#record-attendance" class="btn btn-lg btn-custom btn-block waves-effect m-t-20 waves-light">
                        Record Attendance
                    </a>
                    <div class="mt-5 d-none d-xl-block">
                        <h5 class="text-center">How It Works ?</h5>

                        <ul class="pl-3">
                            <li class="text-muted mb-3">
                                Select any date on the calendar to begin.
                            </li>
                            <li class="text-muted mb-3">
                                Select a site you want to view attendance for.
                            </li>
                        </ul>
                    </div>
                </div> <!-- end col-->
                <div class="col-lg-9">
                    <div id="calendar"></div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>

        <!-- BEGIN MODAL -->
        <div class="modal fade" id="view-attendance" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center border-bottom-0 d-block">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">View Attendance</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group col-md-12">
                                <select class="selectpicker show-tick" data-style="btn-light" title="Select A Site"
                                    id="site" name="site">
                                    @foreach($sites as $site)
                                        <option value="{{$site->id}}">{{$site->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button id="view_attendance" class="btn btn-success waves-effect w-md mr-2 mb-2">
                                View Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Add Category -->
        <div class="modal fade" id="record-attendance" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center border-bottom-0 d-block">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title mt-2">Record Attendance</h4>
                    </div>
                    <div class="modal-body p-4">
                        <form role="form">
                            <div class="mb-4">
                                <p class="mb-1 font-weight-bold text-muted">Search for guard<br /><span
                                        class="text-muted" style="font-weight: 300; font-size: 12px;"><i>Begin
                                            typing a guard's name in the box below</i></span></p>
                                <input type="text" name="guard" id="autocomplete" class="form-control" />
                                <input type="hidden" name="guard_id" id="guard_id" />
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-6 col-sm-12">
                                    <label class="font-weight-bold text-muted">Date in</label>
                                    <input class="form-control" id="date_in"/>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="font-weight-bold text-muted">Time in</label>
                                    <input class="form-control" id="time_in"/>
                                </div>
                            </div>
                        </form>

                        <div class="text-right">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom ml-1 waves-effect waves-light save-category"
                                data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    <!-- end col-12 -->
</div> <!-- end row -->
@endsection
@section('modals')
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">Attendance</h4>
        <div class="custom-modal-text">
            <div class="loader">
                <div class="sk-rotating-plane"></div>
            </div>
            <div class="row col-sm-12" id="attendance_div">
                <table id="attendance" class="table table-bordered table-striped table-hover dt-responsive nowrap">
                    <thead>
                        <th>Guard Name</th>
                        <th>Time In</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Jquery-Ui -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!--Animations-->
    <script src="{{asset('plugins/custombox/js/custombox.min.js')}}"></script>
    <script src="{{asset('plugins/custombox/js/legacy.min.js')}}"></script>

    <!-- SCRIPTS -->
    <script src="{{asset('plugins/moment/moment.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/js/fullcalendar.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('plugins/autocomplete/jquery.autocomplete.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.js')}}"></script>

    
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <script>
        var string = "{{$guards}}";
        var attendance_date;
        
        var string = string.replace(/&quot;/g, '"');
        var string = string.replace(/&amp;/g, '&');
        
        
        var guards = JSON.parse(string);

        var formatted = $.map(guards, function (guard) { return { value: guard.firstname+' '+guard.lastname, data: { id: guard.id } }; });


        $('#calendar').fullCalendar({
            dayClick: function (day) {
                attendance_date = day.format();
                $('#view-attendance').modal('show');
            },
            defaultView: 'month'
        });

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

        $('#date_in').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#time_in').timepicker({
            defaultTIme: false,
            icons: {
                up: 'mdi mdi-chevron-up',
                down: 'mdi mdi-chevron-down'
            },
            minuteStep: 1,
        });
        
        $('#site').on('change', function(){
            if($(this).val() != null || $(this).val() == ''){
                $('#view_attendance').css('display', 'block');
            }
        });

        $('#view_attendance').on('click', function(e){
            e.preventDefault();
            
            $('.loader').css('display', 'block');
            $('#attendance_div').css('display', 'none');

            if(attendance_date == null){
                $(this).closest('.modal-body').append('<span class="text-danger text-small">Select a date </span>');
            }else{
                    var data = 'date='+attendance_date+'&site='+$('#site').val();  
                    console.log(data);
                    
                    $.ajax({
                            url: '/api/attendance',
                            method: 'GET',
                            data: data,
                            success: function(data){
                                var attendances = [];

                                var table = $('#attendance').DataTable();
                                table.clear().draw();

                                for(var i = 0; i < data.data.length; i++){
                                    table.row.add([
                                        data.data[i].owner_guard.firstname + ' ' + data.data[i].owner_guard.lastname,
                                        data.data[i].date_time
                                    ]).draw();
                                }
                                
                                $('.loader').css('display', 'none');
                                $('#attendance_div').css('display', 'block');
                                
                            },
                            error: function(error){
                                console.log(data);
                            }
                    });
              
                    
                    Custombox.open({
                    target: '#custom-modal',
                    effect: 'push',
                    overlaySpeed: '100',
                    overlayColor: '#36404a',
                    fullscreen: true,
                    onOpen: function(){
                        return 0;
                    },
                    onClose: function(){
                        return 0;
                    },
                    onComplete: function(){
                        return 0;
                    }
                });
            }
        })
        
    </script>
@endsection
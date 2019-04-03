@extends('layouts.main-layout', ['page_title' => $client->name])
@section('styles')
<link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
<style>
    .text-small{
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<div class="row">
        <div class="col-sm-12">
                    <!-- meta -->
            <div class="profile-user-box card-box bg-custom">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="media-body text-white">
                            <h4 class="mt-1 mb-1 font-18">{{$client->name}}</h4>
                            <p class="font-13 text-light">Security Provision</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            <button type="button" class="btn btn-light waves-effect">
                                Edit Client
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                    <!--/ meta -->
        </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Project Details</h4>
                        <div class="panel-body">
                            <p class="text-muted font-13" style="min-height: 120px;">
                                {{$client->description}}
                            </p>

                            <hr />

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Client Name :</strong> <span class="m-l-15">{{$client->name}}</span></p>

                                <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{$client->phone_number}}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{$client->email}}</span></p>

                                <p class="text-muted font-13"><strong>Contract Start :</strong> <span class="m-l-15">{{Carbon\Carbon::parse($client->start_date)->format('jS F Y')}}</span></p>

                                <p class="text-muted font-13"><strong>Contract End :</strong> <span class="m-l-15">{{Carbon\Carbon::parse($client->end_date)->format('jS F Y')}}</span></p>


                            </div>
                        </div>
                    </div>
                    <!-- Personal-Information -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-primary">Sites</div>
                        <div class="clearfix"></div>
                        <div class="inbox-widget">
                            @foreach($client->sites as $site)
                            <a href="#">
                                <div class="inbox-item">
                                    <p class="inbox-item-author">{{$site->name}}</p>
                                    <p class="inbox-item-text">{{$site->location}}</p>
                                    <p class="inbox-item-date m-t-10">
                                        <button type="button" class="btn btn-icon btn-sm waves-effect waves-light btn-success">
                                            View </button>
                                    </p>
                                </div>
                            </a>
                            @endforeach
                            @if($client->sites->count() < 1)
                                <p class="text-muted">No sites for this client yet. Add one.</p>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="col-xl-8">

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="card-box tilebox-one">
                                <i class="icon-people float-right text-muted"></i>
                                <h6 class="text-muted text-uppercase mt-0">Guards</h6>
                                <h2 class="m-b-20">{{$client->guards->count()}}</h2>
                            </div>
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card-box tilebox-one">
                                <i class="icon-home float-right text-muted"></i>
                                <h6 class="text-muted text-uppercase mt-0">Sites</h6>
                                <h2 class="m-b-20"><span>{{$client->sites->count()}}</span></h2>
                            </div>
                        </div><!-- end col -->

                        <div class="col-sm-4">
                            <div class="card-box tilebox-one">
                                <i class="icon-calender float-right text-muted"></i>
                                <h6 class="text-muted text-uppercase mt-0">Days Elapsed</h6>
                                <?php $date = Carbon\Carbon::parse($client->start_date)?>
                                <h2 class="m-b-20">{{$date->diffInDays(Carbon\Carbon::now())}}
                                    @if(!$date->isPast())
                                        <span class="text-muted text-small"> DAYS FROM TODAY</span>
                                    @endif
                                </h2>
                            </div>
                        </div><!-- end col -->

                    </div>
                    <!-- end row -->
            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Reports</h4>
                <div class="">
                    <div class="row mb-4">
                        <div class="col-sm-8">
                            <div class="project-sort float-right">
                                <div class="project-sort-item">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <select class="selectpicker show-tick" data-style="btn-primary"
                                                title="Report Type" id="marital">
                                                <option selected>All Sites ({{$client->sites->count()}})</option>
                                                @foreach($client->sites as $site)
                                                    <option value="{{$site->id}}">{{$site->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date" placeholder="Date">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="lineChart" height="350" class="mt-4"></canvas>
            </div>

            <div class="card-box">
                <h4 class="header-title mb-3">Add Site</h4>

                <form class="form-horizontal" id="new_site_form">
                    <div class="form-row m-b-25">
                        <div class="col-md-6 col-sm-12">
                            <label for="name">Site Name</label>
                            <input class="form-control" type="text" id="name" placeholder="Codbit ADC" name="name">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="location">Site Location</label>
                            <input class="form-control" type="text" id="location" placeholder="Ring Road Central"
                                name="location">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="garuantor_phone_number" class="col-form-label"><b>Contact Number</b></label>
                            <input type="tel" placeholder="" class="form-control" name="phone_number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="supervisor" class="col-form-label"><b>&nbsp;</b></label>
                            <select class="selectpicker show-tick" data-style="btn-primary" 
                            title="Supervisor" id="supervisor" name="guard_id" data-live-search="true">
                                @foreach($guards as $guard)
                                <option value="{{$guard->id}}" data-subtext="{{$guard->phone_number}}">{{$guard->firstname.' '.$guard->lastname}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="client_id" value="{{$client->id}}"/>
                        </div>
                    </div>
                    <div class="form-group account-btn text-center m-t-10">
                        <div class="col-12">
                            <button class="btn w-lg btn-custom waves-effect waves-light" type="submit">Add
                                Site</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
                <!-- end col -->

    </div>
@endsection
@section('scripts')
    <!--Telephone Mask-->
    <script src="{{asset('/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
    
    <!--Bootstrap Datepicker-->
    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    
    <!--JQUERY toast-->
    <script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>
    
    <!-- Chart JS -->
    <script src="{{asset('plugins/chart.js/chart.bundle.js')}}"></script>
    
    <!--Bootstrap Select-->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>

    <script>
        !function ($) {
            "use strict";

            var ChartJs = function () { };

            ChartJs.prototype.respChart = function (selector, type, data, options) {
                // get selector by context
                var ctx = selector.get(0).getContext("2d");
                // pointing parent container to make chart js inherit its width
                var container = $(selector).parent();

                // enable resizing matter
                $(window).resize(generateChart);

                // this function produce the responsive Chart JS
                function generateChart() {
                    // make chart width fit with its container
                    var ww = selector.attr('width', $(container).width());
                    switch (type) {
                        case 'Line':
                            new Chart(ctx, { type: 'line', data: data, options: options });
                            break;
                        default:
                            break;
                    }
                    // Initiate new chart or Redraw

                };
                // run function - render chart at first load
                generateChart();
            },

                //init
                ChartJs.prototype.init = function () {
                    //creating lineChart
                    var lineChart = {
                        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                        datasets: [{
                            label: "Kpone",
                            fill: false,
                            backgroundColor: '#4eb7eb',
                            borderColor: '#4eb7eb',
                            data: [44, 60, 33, 58, 4, 57, 89]
                        }, {
                            label: "Kumasi",
                            fill: false,
                            backgroundColor: '#e3eaef',
                            borderColor: "#e3eaef",
                            borderDash: [5, 5],
                            data: [68, 41, 86, 49, 2, 65, 64, 86, 49, 2]
                        }]
                    };

                    var lineOpts = {
                        responsive: true,
                        // title:{
                        //     display:true,
                        //     text:'Chart.js Line Chart'
                        // },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                // scaleLabel: {
                                //     display: true,
                                //     labelString: 'Month'
                                // },
                                gridLines: {
                                    color: "rgba(0,0,0,0.1)"
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: "rgba(255,255,255,0.05)",
                                    fontColor: '#fff'
                                },
                                ticks: {
                                    max: 100,
                                    min: -100,
                                    stepSize: 20
                                }
                            }]
                        }
                    };

                    this.respChart($("#lineChart"), 'Line', lineChart, lineOpts);
                },
                $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

        }(window.jQuery),

            //initializing
            function ($) {
                "use strict";
                $.ChartJs.init()
            }(window.jQuery);

        $('#date').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('.selectpicker').selectpicker();
        
        $('#new_site_form').on('submit', function(e){
            e.preventDefault();

            var btn = $(this).find('[type="submit"]');
            var data = $(this).serialize();

            applyLoading(btn)

            $.ajax({
                url: '/api/sites/add',
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
                        $('#new_site_form').trigger('reset');
                        $.toast({
                            text : data.message,
                            heading : 'Done',
                            position: 'top-right',
                            bgColor : '#5cb85c',
                            showHideTransition : 'slide'
                        });

                        $('.inbox-widget').append('<a href="#">'+
                        '<div class="inbox-item"><p class="inbox-item-author">'+data.data.name+'</p>'+
                        '<p class="inbox-item-text">'+data.data.location+'</p><p class="inbox-item-date m-t-10">'+
                        '<button type="button" class="btn btn-icon btn-sm waves-effect waves-light btn-success">'+
                        'View </button></p></div></a>'); 
                            
                    }
                },
                error: function(err){
                    $.toast({
                            text : 'Network error',
                            heading : 'Error',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#d9534f'
                        });
                }
            })
        })
    </script>
@endsection
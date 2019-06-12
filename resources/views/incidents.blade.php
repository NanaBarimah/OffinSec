@extends('layouts.main-layout', ['page_title' => 'Incidents'])
@section('styles')
<!--Bootstrap Select-->
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    <form class="form-inline" action="#">
        <div class="input-group">
            <select class="selectpicker show-tick col-md-10" data-style="btn btn-custom" data-live-search="true" 
            title="Select site" id="site_id" name="site_id">
                @foreach($clients as $client)
                    <optgroup label="{{$client->name}}">
                    @foreach($client->sites as $site)
                        <option value="{{$site->id}}">{{$site->name}}</option>
                    @endforeach
                    </optgroup>
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="input-group-text btn-custom" type="submit" style="cursor:pointer"><i class="mdi mdi-magnify"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="row incidents">
    <div class="col-12">
        <div class="">
            <div class="timeline">
                <article class="timeline-item alt">
                    <div class="text-right">
                        <div class="time-show first">
                            <a href="#" class="btn btn-custom w-lg">Today</a>
                        </div>
                    </div>
                </article>
                <article class="timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">1 hour ago</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? </p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item ">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">2 hours ago</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>consectetur adipisicing elit. Iusto, optio, dolorum <a href="#">John deon</a> provident rerum aut hic quasi placeat iure tempora laudantium </p>

                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">10 hours ago</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>3 new photo Uploaded on facebook fan page</p>
                                <div class="album">
                                    <a href="#">
                                        <img alt="" src="assets/images/small/img-1.jpg">
                                    </a>
                                    <a href="#">
                                        <img alt="" src="assets/images/small/img-2.jpg">
                                    </a>
                                    <a href="#">
                                        <img alt="" src="assets/images/small/img-3.jpg">
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">14 hours ago</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Outdoor visit at California State Route 85 with John Boltana &
                                    Harry Piterson regarding to setup a new show room.</p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">19 hours ago</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Jonatha Smith added new milestone <span><a href="#">Pathek</a></span>
                                    Lorem ipsum dolor sit amet consiquest dio</p>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="timeline-item alt">
                    <div class="text-right">
                        <div class="time-show">
                            <a href="#" class="btn btn-custom w-lg">Yesterday</a>
                        </div>
                    </div>
                </article>
                <article class="timeline-item">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">07 January 2018</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Montly Regular Medical check up at Greenland Hospital by the
                                    doctor <span><a href="#"> Johm meon </a></span>
                                </p>

                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">07 January 2018</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Download the new updates of Ubold admin dashboard</p>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="timeline-item">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">07 January 2018</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Jonatha Smith added new milestone <span><a class="blue" href="#">crishtian</a></span>
                                    Lorem ipsum dolor sit amet consiquest dio</p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="timeline-item alt">
                    <div class="text-right">
                        <div class="time-show">
                            <a href="#" class="btn btn-custom w-lg">Last Month</a>
                        </div>
                    </div>
                </article>

                <article class="timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">31 December 2017</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Download the new updates of Ubold admin dashboard</p>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="timeline-item">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon bg-custom"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="text-custom">16 Decembar 2017</h4>
                                <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                <p>Jonatha Smith added new milestone <span><a href="#">prank</a></span>
                                    Lorem ipsum dolor sit amet consiquest dio</p>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
            <!-- end timeline -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
@endsection
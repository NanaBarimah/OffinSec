@extends('layouts.main-layout', ['page_title' => 'Clients'])

@section('styles')
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row mb-4">
                <div class="col-sm-4">
                    <button href="#custom-modal" class="btn btn-custom waves-effect w-md mr-2 mb-2" data-animation="contentscale"
                        data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle"></i>
                        New Client</button>
                </div>
                <div class="col-sm-8">
                    <div class="project-sort float-right">
                        <div class="project-sort-item">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="phase-select">Phase :</label>
                                    <select class="form-control ml-2 form-control-sm" id="phase-select">
                                        <option>All Clients (6)</option>
                                        <option>Ongoing</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sort-select">Sort :</label>
                                    <select class="form-control ml-2 form-control-sm" id="sort-select">
                                        <option>Date</option>
                                        <option>Name</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-xl-4">
                    <div class="card-box project-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown"
                                aria-expanded="false">
                                <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Add Site</a>
                                <a class="dropdown-item" href="#">Send Report</a>
                            </div>
                        </div>
                        <p class="text-muted text-uppercase mb-0 font-13">info@bostgh.com</p>
                        <h4 class="mt-0 mb-3"><a href="" class="text-dark">Bost Ghana Limited</a></h4>
                        <p class="text-muted font-13">Lorem Ipsum is simply dummy text that we at Codbit use
                            to represent text we have no idea of in the futurue
                        </p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h3 class="mb-0">124</h3>
                                <p class="text-muted">Guards</p>
                            </li>
                            <li class="list-inline-item">
                                <h3 class="mb-0">4</h3>
                                <p class="text-muted">Sites guarded</p>
                            </li>
                        </ul>

                        <div class="project-members mb-4">
                            <label class="mr-3">Guards :</label>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="William Ntiamoah">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masawudu">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mr. Luqman">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Conscious Man">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Username">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>
                            <span href="#" class="text-muted">and 10 others</span>
                        </div>

                        <label class="">Completion : <span class="text-custom">55/85</span></label>
                        <div class="progress mb-1" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="(55/85)*100" aria-valuemin="0"
                                aria-valuemax="100" style="width: 80%;">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                    </div>
                </div><!-- end col-->
                <div class="col-xl-4">
                    <div class="card-box project-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown"
                                aria-expanded="false">
                                <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Add Site</a>
                                <a class="dropdown-item" href="#">Send Report</a>
                            </div>
                        </div>
                        <p class="text-muted text-uppercase mb-0 font-13">info@bostgh.com</p>
                        <h4 class="mt-0 mb-3"><a href="" class="text-dark">Bost Ghana Limited</a></h4>
                        <p class="text-muted font-13">Lorem Ipsum is simply dummy text that we at Codbit use
                            to represent text we have no idea of in the futurue
                        </p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h3 class="mb-0">124</h3>
                                <p class="text-muted">Guards</p>
                            </li>
                            <li class="list-inline-item">
                                <h3 class="mb-0">4</h3>
                                <p class="text-muted">Sites guarded</p>
                            </li>
                        </ul>

                        <div class="project-members mb-4">
                            <label class="mr-3">Guards :</label>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="William Ntiamoah">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masawudu">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mr. Luqman">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Conscious Man">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Username">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>
                            <span href="#" class="text-muted">and 10 others</span>
                        </div>

                        <label class="">Completion : <span class="text-custom">55/85</span></label>
                        <div class="progress mb-1" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="(55/85)*100" aria-valuemin="0"
                                aria-valuemax="100" style="width: 80%;">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                    </div>
                </div><!-- end col-->
                <div class="col-xl-4">
                    <div class="card-box project-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown"
                                aria-expanded="false">
                                <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Add Site</a>
                                <a class="dropdown-item" href="#">Send Report</a>
                            </div>
                        </div>
                        <p class="text-muted text-uppercase mb-0 font-13">info@bostgh.com</p>
                        <h4 class="mt-0 mb-3"><a href="" class="text-dark">Bost Ghana Limited</a></h4>
                        <p class="text-muted font-13">Lorem Ipsum is simply dummy text that we at Codbit use
                            to represent text we have no idea of in the futurue
                        </p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h3 class="mb-0">124</h3>
                                <p class="text-muted">Guards</p>
                            </li>
                            <li class="list-inline-item">
                                <h3 class="mb-0">4</h3>
                                <p class="text-muted">Sites guarded</p>
                            </li>
                        </ul>

                        <div class="project-members mb-4">
                            <label class="mr-3">Guards :</label>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="William Ntiamoah">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masawudu">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mr. Luqman">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Conscious Man">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Username">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>
                            <span href="#" class="text-muted">and 10 others</span>
                        </div>

                        <label class="">Completion : <span class="text-custom">55/85</span></label>
                        <div class="progress mb-1" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="(55/85)*100" aria-valuemin="0"
                                aria-valuemax="100" style="width: 80%;">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                    </div>
                </div><!-- end col-->
                <div class="col-xl-4">
                    <div class="card-box project-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown"
                                aria-expanded="false">
                                <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Add Site</a>
                                <a class="dropdown-item" href="#">Send Report</a>
                            </div>
                        </div>
                        <p class="text-muted text-uppercase mb-0 font-13">info@bostgh.com</p>
                        <h4 class="mt-0 mb-3"><a href="" class="text-dark">Bost Ghana Limited</a></h4>
                        <p class="text-muted font-13">Lorem Ipsum is simply dummy text that we at Codbit use
                            to represent text we have no idea of in the futurue
                        </p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h3 class="mb-0">124</h3>
                                <p class="text-muted">Guards</p>
                            </li>
                            <li class="list-inline-item">
                                <h3 class="mb-0">4</h3>
                                <p class="text-muted">Sites guarded</p>
                            </li>
                        </ul>

                        <div class="project-members mb-4">
                            <label class="mr-3">Guards :</label>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="William Ntiamoah">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masawudu">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mr. Luqman">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Conscious Man">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>

                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Username">
                                <img src="assets/images/avatar.jpg" class="rounded-circle thumb-sm" alt="friend" />
                            </a>
                            <span href="#" class="text-muted">and 10 others</span>
                        </div>

                        <label class="">Completion : <span class="text-custom">55/85</span></label>
                        <div class="progress mb-1" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0"
                                aria-valuemax="100" style="width: 15%;">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->
@endsection
@section('modals')
<div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">New Guarantor</h4>
        <div class="custom-modal-text">
            <form class="form-horizontal" action="#" id="new_guarantor">

                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="name">Client Name</label>
                        <input class="form-control" type="text" id="name" placeholder="Codbit Ghana Ltd" name="name">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="email">Email address</label>
                        <input class="form-control" type="text" id="email" placeholder="info@codbitgh.com" name="email">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="email">Phone</label>
                        <input type="tel" placeholder="" data-mask="(999) 999-999999" class="form-control" name="phone">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="contact_person">Contact Person Name</label>
                        <input class="form-control" type="text" id="email" placeholder="Abraham Attah" name="contact_person">
                    </div>
                    <div class="form-group col-md-8">
                        <label>Contract Duration</label>
                        <div>
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start" placeholder="Start" />
                                <input type="text" class="form-control" name="end" placeholder="End" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="no_of_guards">No. of Guards</label>
                        <input class="form-control" type="number" min="1" id="no_of_guards" name="no_of_guards">
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <label for="description">Job Description</label>
                        <input class="form-control" type="text" id="description" name="description">
                    </div>
                </div>
                <div class="form-group account-btn text-center m-t-10">
                    <div class="col-12">
                        <button class="btn w-lg btn-custom waves-effect waves-light" type="submit">Add
                            Client</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')


    <!--Animations-->
    <script src="{{asset('plugins/custombox/js/custombox.min.js')}}"></script>
    <script src="{{asset('plugins/custombox/js/legacy.min.js')}}"></script>


    <!--Telephone Mask-->
    <script src="{{asset('/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
    <!--Bootstrap Datepicker-->
    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        jQuery.browser = {};
        (function () {
            jQuery.browser.msie = false;
            jQuery.browser.version = 0;
            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                jQuery.browser.msie = true;
                jQuery.browser.version = RegExp.$1;
            }
        })();

        jQuery('#date-range').datepicker({
            toggleActive: true
        });

    </script>
@endsection
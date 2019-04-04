@extends('layouts.main-layout', ['page_title' => 'Home'])

@section('content')
    <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Business Overview</h4>

                        <div class="row">
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="card-box mb-0 widget-chart-two">
                                    <div class="widget-chart-two-content">
                                        <p class="text-muted mb-0 mt-2">Guard Count</p>
                                        <h3 class="">{{ $guards }}</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="card-box mb-0 widget-chart-two">
                                    <div class="widget-chart-two-content">
                                        <p class="text-muted mb-0 mt-2">Client Count</p>
                                        <h3 class="">{{ $clients }}</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="card-box mb-0 widget-chart-two">
                                    <div class="widget-chart-two-content">
                                        <p class="text-muted mb-0 mt-2">System User Count</p>
                                        <h3 class="">{{ $users }}</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="card-box mb-0 widget-chart-two">
                                    <div class="widget-chart-two-content">
                                        <p class="text-muted mb-0 mt-2">Total Monthly Deductions</p>
                                        <h3 class="">{{ $deductions }}</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card-box">
                        <h4 class="header-title mb-3">MOST PUNCTUAL GUARDS</h4>

                        <div class="table-responsive">
                            <table class="table table-hover table-centered m-0">

                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Name</th>
                                        <th>Current Site</th>
                                        <th>Earliest Check In</th>
                                        <th>Latest Check In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/avatar.jpg" alt="Kwame Dawuro" title="contact-img"
                                                class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            Kwame Dawuro
                                        </td>

                                        <td>
                                            BOST Kpone
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:30 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:31 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/avatar.jpg" alt="Kwame Dawuro" title="contact-img"
                                                class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            Kwame Dawuro
                                        </td>

                                        <td>
                                            BOST Kpone
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:30 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:31 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/avatar.jpg" alt="Kwame Dawuro" title="contact-img"
                                                class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            Kwame Dawuro
                                        </td>

                                        <td>
                                            BOST Kpone
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:30 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:31 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/avatar.jpg" alt="Kwame Dawuro" title="contact-img"
                                                class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            Kwame Dawuro
                                        </td>

                                        <td>
                                            BOST Kpone
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:30 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:31 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/avatar.jpg" alt="Kwame Dawuro" title="contact-img"
                                                class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            Kwame Dawuro
                                        </td>

                                        <td>
                                            BOST Kpone
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:30 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">4:31 a.m.</h5>
                                            <p class="mb-0 text-muted"><small>20th December,</small></p>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-xl-4">
                    <div>
                        <h4 class="m-t-0 mb-4 header-title">Quick Links</h4>

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="col-8">
                                    <h5>
                                        <a href="#">Send a client report</a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="col-8">
                                    <h5>
                                        <a href="#">Send a client report</a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="col-8">
                                    <h5>
                                        <a href="#">Send a client report</a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="col-8">
                                    <h5>
                                        <a href="#">Send a client report</a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
@endsection

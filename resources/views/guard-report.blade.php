@extends('layouts.main-layout', ['page_title' => 'Guard Reports'])
@section('styles')
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Select A Report Type</h4>
                        <div class="panel-body">

                            <form action="#" id="report_type">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <select class="form-control selectpicker">
                                            <option value="1">Guards by site</option>
                                            <option value="2">Guards by gender</option>
                                            <option value="3">Guards by age distribution</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                </div>
                                <div class="text-right mt-4">                               
                                    <button type="submit" class="btn btn-custom">View Report</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                    <!-- offences forms -->



                </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
@endsection
@extends('layouts.main-layout', ['page_title' => ucwords($guard->firstname.' '.$guard->lastname)])
@section('styles')

@endsection
@section('content')
                <div class="row">
                    <div class="col-sm-12">
                        <!-- meta -->
                        <div class="profile-user-box card-box bg-custom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="float-left mr-3"><img src="{{asset('assets/images/guards/'.$guard->photo)}}" alt="" class="thumb-lg rounded-circle"></span>
                                    <div class="media-body text-white">
                                        <h4 class="mt-1 mb-1 font-18">{{$guard->firstname.' '.$guard->lastname}}</h4>
                                        <p class="font-13 text-light"> {{$guard->phone_number}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger waves-effect">
                                            Delete Guard
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
                        <h4 class="header-title mt-0 m-b-20">Guard Details</h4>
                        <div class="panel-body">
                            <hr />

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Guard Name :</strong> <span class="m-l-15">{{$guard->name.' '.$guard->lastname}}</span></p>

                                <p class="text-muted font-13"><strong>Mobile Number:</strong><span class="m-l-15">{{$guard->phone_number}}</span></p>

                                <p class="text-muted font-13"><strong>Emergency :</strong> <span class="m-l-15">{{$guard->emergency_contact}}</span></p>

                                <p class="text-muted font-13"><strong>Gender :</strong> <span class="m-l-15">{{$guard->gender}}</span></p>

                                <p class="text-muted font-13"><strong>Date of birth :</strong> <span class="m-l-15">{{Carbon\Carbon::parse($guard->dob)->format('jS F Y')}}</span></p>

                                <p class="text-muted font-13"><strong>Residential Address :</strong> <span class="m-l-15">{{$guard->address}}</span></p>

                            </div>
                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>


                <div class="col-xl-8">

            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Edit Guard</h4>
                <hr/>
                <form class="">
                    <div class="row mb-4">
                        
                    </div>
                </form>
            </div>
        </div>
@endsection
@section('scripts')

@endsection
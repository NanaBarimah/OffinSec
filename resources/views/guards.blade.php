@extends('layouts.main-layout', ['page_title' => 'Guards'])
@section('content')
<div class="row">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-custom w-md waves-effect waves-light mb-4">
                         New Guard</button>
                </div>
                <div class="col-sm-8">
                    <div class="project-sort float-right">
                        <div class="project-sort-item">
                            <form class="form-inline">
                                <div class="form-group">
                                    <input class="form-control ml-2 form-control-sm" id="search" placeholder="Search"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end col-->
            </div>

            <div class="row">
                @if($guards->count() < 1)
                    <div class="jumbotron p-4">
                        <h1 class="display-4">No guards yet :( </h1>
                        <p class="lead">You haven't registered any guards yet. Add a new guard to view and manage.</p>
                        <hr class="my-4">
                        <p>Simply use the "Add New" button to begin registering a new guard.</p>
                    </div>
                @endif
                @foreach($guards as $guard)
                <div class="col-lg-4">
                    <div class="text-center card-box">

                        <div class="member-card pt-2 pb-2">
                            <div class="thumb-lg member-thumb m-b-10 mx-auto">
                                <img src="{{asset('assets/images/guards/'.$guard->photo)}}" onerror="this.src={{asset('assets/images/avatar.jpg')}}" class="rounded-circle img-thumbnail" alt="profile-image" style="width:78px; height:78px; object-fit: center;">
                            </div>

                            <div class="">
                                <h4 class="m-b-5">{{ucwords($guard->firstname).' '.ucwords($guard->lastname)}}</h4>
                                <p class="text-muted"> 
                                    @if($guard->duty_rosters->count() < 1)
                                     No site assigned 
                                     @else 
                                     {{$guard->duty_roster->site->name}} 
                                    @endif 
                                    <span> | </span> <span> <span class="text-pink">{{$guard->phone_number}}</span>
                                    </span></p>
                            </div>
                            <a href="/guard/{{$guard->id}}" class="btn btn-primary m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light">
                                View Details
                            </a>
                        </div>

                    </div>

                </div>
                @endforeach 
                {{$guards->links()}}
            </div>
@endsection
@extends('layouts.main-layout', ['page_title' => 'Clients'])

@section('styles')
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
    <style>
        .text-small{
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
<div class="row mb-4">
                <div class="col-sm-4">
                    <button href="#custom-modal" class="btn btn-custom waves-effect w-md mr-2 mb-2" data-animation="contentscale"
                        data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">
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
                @if($clients->count() < 1)
                    <div class="jumbotron p-4">
                        <h1 class="display-4">No clients yet :( </h1>
                        <p class="lead">You haven't registered any clients yet. Add a new client to view and manage.</p>
                        <hr class="my-4">
                        <p>Simply use the "Add New" button to begin registering a new client.</p>
                    </div>
                @endif
                @foreach($clients as $client)
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
                        <p class="text-muted text-uppercase mb-0 font-13">{{ $client->email }}</p>
                        <h4 class="mt-0 mb-3"><a href="/client/{{$client->id}}" class="text-dark">{{ $client->name }}</a></h4>
                        <p class="text-muted font-13" style="min-height: 60px;">{{ $client->description }}
                        </p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h3 class="mb-0">{{$client->number_of_guards}}</h3>
                                <p class="text-muted">Guards</p>
                            </li>
                            <li class="list-inline-item">
                                <h3 class="mb-0">{{$client->sites->count()}}</h3>
                                <p class="text-muted">Sites guarded</p>
                            </li>
                        </ul>

                        <div class="project-members mb-4">
                            <label class="mr-3">Guards :</label>
                            <?php $count = 1; ?>
                            @foreach($client->guards as $guard)
                                @if($count > 5)
                                    @break;
                                @endif
                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$guard->firstname.' '.$guard->lastname}}">
                                    <img src="{{$guard->photo == '' || $guard->photo == null ? asset('assets/images/guards/'.$guard->photo) : asset('assets/images/avatar.jpg')}}" onerror="this.src={{asset('assets/images/avatar.jpg')}}" class="rounded-circle thumb-sm" alt="friend" />
                                </a> 

                                <?php $count++; ?>   
                            @endforeach
                            @if($client->guards->count() > 5)
                            <span href="#" class="text-muted">and {{$client->guards->count() - 5}} other
                                @if($client->guards->count() > 6)<span>s</span>@endif
                            </span>
                            @endif
                            @if($client->guards->count() < 1)
                            <span href="#" class="text-muted">
                                No guards have been assigned to this client yet. Add a site to assign guards.
                            </span>
                            @endif
                        </div>

                        <label class="">Completion : <span class="text-custom">55/85</span></label>
                        <div class="progress mb-1" style="height: 7px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="(55/85)*100" aria-valuemin="0"
                                aria-valuemax="100" style="width: 80%;">
                            </div><!-- /.progress-bar .progress-bar-danger -->
                        </div><!-- /.progress .no-rounded -->

                    </div>
                </div><!-- end col-->
                @endforeach
            </div>
            <!-- end row -->
@endsection
@section('modals')
<div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">New Client</h4>
        <div class="custom-modal-text">
            <form class="form-horizontal" action="#" id="new_client">
                @csrf
                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="name">Client Name</label>
                        <input class="form-control resetable" type="text" id="name" placeholder="Codbit Ghana Ltd" name="name">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="email">Email address</label>
                        <input class="form-control resetable" type="text" id="email" placeholder="info@codbitgh.com" name="email">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="email">Phone</label>
                        <input type="tel" placeholder="" data-mask="(999) 999-999999" class="form-control resetable" name="phone_number">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="contact_person">Contact Person Name</label>
                        <input class="form-control resetable" type="text" id="email" placeholder="Abraham Attah" name="contact_person_name">
                    </div>
                    <div class="form-group col-md-8">
                        <label>Contract Duration</label>
                        <div>
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start" placeholder="Start" />
                                <input type="text" class="form-control" name="end" placeholder="End" />
                            </div>
                            <span class="text-danger text-small" id="date_error"></span>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="no_of_guards">No. of Guards</label>
                        <input class="form-control resetable" type="number" min="1" id="no_of_guards" name="number_of_guards">
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <label for="description">Job Description</label>
                        <input class="form-control resetable" type="text" id="description" name="description">
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
    
    <!--JQUERY toast-->
    <script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>

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


        $('#new_client').on('submit', function(e){
            e.preventDefault();
            var error = false;
            
            $(this).find('.resetable').each(function(){
                if($(this).val()=='' || $(this).val()==null){
                    error = true;
                    $(this).closest('div').append('<span class="text-danger text-small">This field is required</span>')
                }
            });

            $('.input-group').find('input').each(function(){
                if($(this).val()=='' || $(this).val() == null){
                    error = true;
                    $('#date_error').html('All date fields are required');
                } 
            })

            if(!error){
                $('.text-danger').css('display', 'none');

                data = $(this).serialize();
                btn = $(this).find('[type="submit"]');

                applyLoading(btn);

                $.ajax({
                    url: 'api/client/add',
                    method: 'POST',
                    data: data,
                    success: function(data){
                        removeLoading(btn, 'Add Client');
                            if(data.error){
                                removeLoading(btn, 'Add Client');
                                Custombox.close();

                                $.toast({
                                    text : data.message,
                                    heading : 'Error',
                                    position: 'top-right',
                                    showHideTransition : 'slide', 
                                    bgColor: '#d9534f'
                                });
                            }else{
                                Custombox.close();

                                $('#new_client').trigger('reset');
                                $.toast({
                                    text : data.message,
                                    heading : 'Done',
                                    position: 'top-right',
                                    bgColor : '#5cb85c',
                                    showHideTransition : 'slide'
                                });

                                setTimeout(function(){
                                    location.replace('/client/'+data.data.id);
                                }, 500);
                            }
                    },
                    error: function(err){
                        removeLoading(btn, 'Add Client');
                        Custombox.close();

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

    </script>
@endsection
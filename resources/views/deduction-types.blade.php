@extends('layouts.main-layout', ['page_title' => 'Offence Types'])
@section('styles')
<link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
<style>
    .currency{
        font-size: 14px;
    }

    .description{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        line-height: 2em;
        height: 6em;
        max-height: 6em; 
    }

    table{
        font-size: 14px;
    }
</style>
@endsection
@section('content')
            <div class="row mb-4">
                <div class="col-sm-12 col-md-4">
                    <button href="#custom-modal" class="btn btn-custom waves-effect w-md mr-2 mb-2" data-animation="contentscale"
                        data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">
                        New Deduction Type</button>
                </div>
            </div>
            <!-- end row -->
            <div class="row" id="deductions_list">
                @php
                $color_classes = ['custom', 'primary', 'secondary', 'danger', 'warning', 'dark'];
                @endphp
                @foreach($deductions as $deduction)
                    <div class="col-sm-6 col-xl-4">
                        <div class="card-box widget-flat bg-{{$color_classes[array_rand($color_classes)]}} text-white">
                            <i class="fi-lock"></i>
                            <h3 class="m-b-10"><span class="currency">GHS </span>{{$deduction->penalty}}</h3>
                            <p class="text-uppercase m-b-5 font-13 font-600">{{$deduction->name}}</p>
                            <p class="description">{{$deduction->description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
@endsection
@section('modals')
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">New Deduction</h4>
        <div class="custom-modal-text">
            <form class="form-horizontal" action="#" id="new_offence">
                @csrf
                <div class="form-row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="name">Deduction Name</label>
                        <input class="form-control resetable" type="text" id="name" name="name">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="email">Penalty</label>
                        <input class="form-control resetable" type="number" id="penalty" name="penalty">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-12 col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control resetable" id="description" name="description" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group account-btn text-center m-t-10">
                    <div class="col-12">
                        <button class="btn w-lg btn-custom waves-effect waves-light" type="submit">Add
                            Deduction Type</button>
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
<script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}"></script>

<script>
        $('#new_offence').on('submit', function(e){
            e.preventDefault();
            var error = false;
            
            $(this).find('input, textarea').each(function(){
                if($(this).val()=='' || $(this).val()==null){
                    error = true;
                    $(this).closest('div').append('<span class="text-danger text-small">This field is required</span>')
                }
            });

            if(!error){
                $('.text-danger').css('display', 'none');

                data = $(this).serialize();
                btn = $(this).find('[type="submit"]');

                applyLoading(btn);

                $.ajax({
                    url: 'api/offences/add',
                    method: 'POST',
                    data: data,
                    success: function(data){
                        removeLoading(btn, 'Add Deduction Type');
                            if(data.error){
                                removeLoading(btn, 'Add Deduction Type');
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

                                $('#new_offence').trigger('reset');
                                $.toast({
                                    text : data.message,
                                    heading : 'Done',
                                    position: 'top-right',
                                    bgColor : '#5cb85c',
                                    showHideTransition : 'slide'
                                });

                                //add a new card
                                $('#deductions_list').append('<div class="col-sm-6 col-xl-4">'+
                                '<div class="card-box widget-flat bg-custom text-white"><i class="fi-lock"></i>'+
                                '<h3 class="m-b-10"><span class="currency">GHS </span>'+data.data.penalty+'</h3>'+
                                '<p class="text-uppercase m-b-5 font-13 font-600">'+data.data.name+'</p>'+
                                '<p class="description">'+data.data.description+'</p></div></div>');
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
@extends('layouts.app')

@section('content')
        <div id="content" class="content">
			
			<div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h4 class="panel-title">&nbsp;</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal  form-bordered" id="mydata" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4 text-center">
                                        <i class="fas fa-id-card fa-5x"></i>
                                        <h5 class="text-blue">Pendaftaran</h5>
                                        Silahkan masukan NPWP
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">NPWP  Perusahaan</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="npwp" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Nama  Perusahaan</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="perusahaan" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Badan Usaha</label>
                                    <div class="col-lg-8">
                                        <select name="badan_usaha_id" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                            <option value="">Pilih bidang usaha --</option>
                                            @foreach(get_badan_usaha() as $bd)
                                                <option value="{{$bd->id}}">{{$bd->badan_usaha}} ({{$bd->badan_usaha}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Email </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="email" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Password </label>
                                    <div class="col-lg-8">
                                        <input type="password" name="password" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Konfirmasi Password </label>
                                    <div class="col-lg-8">
                                        <input type="password" name="password_confirmation" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1">
                                        
                                    </div>
                                    <div class="col-lg-10 text-center">
                                       
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheckbox">
                                                <label for="agreement_checkbox">
                                                    Dengan ini saya menyatakan bahwa data-data tersebut adalah data yang benar dan dapat dipertanggung jawabkan
                                                </label>
                                           
                                    </div>
                                    <div class="col-lg-1">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1">
                                        
                                    </div>
                                    <div class="col-lg-10 text-center">
                                        <span id="cektrue" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Daftar</span>
                                        <span id="cekfalse" class="btn btn-sm btn-default" ><i class="fa fa-arrow-circle-right"></i> Daftar</span>
                                    </div>
                                    <div class="col-lg-1">
                                        
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                </div>
                
			<!-- end panel -->
		</div>
@endsection

@push('ajax')
    <script>
        $('#cektrue').hide();
        $('#defaultCheckbox').click(function() {
                var checked = $(this).is(':checked');
                if(checked==true){
                    $('#cektrue').show();
                    $('#cekfalse').hide();
                }else{
                    $('#cektrue').hide();
                    $('#cekfalse').show();
                }
        });

        $("#cektrue").click(function(e) {
            
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('pendaftaran/store_rekanan') }}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        document.getElementById("loadnya").style.width = "100%";
                    },
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            document.getElementById("loadnya").style.width = "0px";
                            location.assign("{{url('login')}}");
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            
                            swal({
                                title: 'Notifikasi',
                               
                                html:true,
                                text:'ss',
                                icon: 'error',
                                buttons: {
                                    cancel: {
                                        text: 'Tutup',
                                        value: null,
                                        visible: true,
                                        className: 'btn btn-dangers',
                                        closeModal: true,
                                    },
                                    
                                }
                            });
                            $('.swal-text').html('<div style="width:100%;background:#f2f2f5;padding:1%;text-align:left;font-size:13px">'+msg+'</div>')
                        }
                        
                        
                    }
                
                });
        });
        
    </script>
@endpush

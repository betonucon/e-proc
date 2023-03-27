@extends('layouts.web')
@push('datatable')
    <script type="text/javascript">
        /*
        Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
        Version: 4.6.0
        Author: Sean Ngu
        Website: http://www.seantheme.com/color-admin/admin/
        */

        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                $('#data-table-fixed-header').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('home/get_data')}}",
					columns: [
						{ data: 'tampil' },
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $(document).ready(function() {
            TableManageFixedHeader.init();
        });
    </script>
@endpush
@section('content')
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- <ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol> -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!-- <h1 class="page-header">Dashboard <small>header small text goes here...</small></h1> -->
			
                <div class="row" style="margin-bottom:2% !important" >
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8 text-center" >
                        <p style="font-weight:bold;font-size:22px">{{$data->perusahaan}}</p>
                        
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
				<ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                            <span class="d-sm-none"><i class="fas fa-check-square fa-flip-vertical"></i> Data Perusahaan</span>
                            <span class="d-sm-block d-none"><i class="fas fa-check-square fa-flip-vertical"></i> Data Perusahaan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none"><i class="fas fa-check-square fa-flip-vertical"></i> Komoditi</span>
                            <span class="d-sm-block d-none"><i class="fas fa-check-square fa-flip-vertical"></i> Komoditi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#default-tab-3"  data-toggle="tab" class="nav-link">
                            <span class="d-sm-none"><i class="fas fa-check-square fa-flip-vertical"></i> Personil</span>
                            <span class="d-sm-block d-none"><i class="fas fa-check-square fa-flip-vertical"></i> Personil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#default-tab-4"  data-toggle="tab" class="nav-link">
                            <span class="d-sm-none"><i class="fas fa-check-square fa-flip-vertical"></i> Dokumen</span>
                            <span class="d-sm-block d-none"><i class="fas fa-check-square fa-flip-vertical"></i> Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#default-tab-5"  data-toggle="tab" class="nav-link">
                            <span class="d-sm-none"><i class="fas fa-check-square fa-flip-vertical"></i> BANK Referensi</span>
                            <span class="d-sm-block d-none"><i class="fas fa-check-square fa-flip-vertical"></i> BANK Referensi</span>
                        </a>
                    </li>
                    
                    
                </ul>
				<div class="tab-content">
                    
                    
					<div class="tab-pane fade  active show" id="default-tab-1">
                        
                            <div class="panel panel-inverse" data-sortable-id="chart-js-2" data-init="true">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">DATA PERUSAHAAN</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal  form-bordered" id="mydata" method="post" action="{{ url('vendor/store') }}" enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div class="row">   
                                            <div class="col-md-6">   
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">NPWP  Perusahaan</label>
                                                    <div class="col-lg-4">
                                                        <input disabled type="text" readonly value="{{$data->npwp}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Nama  Perusahaan</label>
                                                    <div class="col-lg-8">
                                                        <input disabled type="text" readonly value="{{$data->perusahaan}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Badan Usaha</label>
                                                    <div class="col-lg-7">
                                                        <select disabled name="badan_usaha_id" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                                            <option value="">Pilih  --</option>
                                                            @foreach(get_badan_usaha() as $bd)
                                                                <option value="{{$bd->id}}" @if($data->badan_usaha_id==$bd->id) selected @endif>{{$bd->badan_usaha}} ({{$bd->badan_usaha}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Negara</label>
                                                    <div class="col-lg-7">
                                                        <select disabled name="negara_id" value="" class="default-select2 form-control form-control-sm" placeholder="ketik disini...">
                                                            <option value="">Pilih  --</option>
                                                            @foreach(get_negara() as $bd)
                                                                <option value="{{$bd->id}}"  @if($data->negara_id==$bd->id) selected @endif >{{$bd->negara}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Status Pemodalan</label>
                                                    <div class="col-lg-7">
                                                        <select disabled name="status_perusahaan_id" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                                            <option value="">Pilih  --</option>
                                                            @foreach(get_status_perusahaan() as $bd)
                                                                <option value="{{$bd->id}}"  @if($data->status_perusahaan_id==$bd->id) selected @endif >{{$bd->status_perusahaan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Jenis Pengadaan</label>
                                                    <div class="col-lg-7">
                                                        <select disabled name="pengadaan_id" class="form-control form-control-sm" placeholder="ketik disini...">
                                                        <option value="">Pilih  --</option>    
                                                        @foreach(get_pengadaan() as $bd)
                                                                <option value="{{$bd->id}}" @if($data->pengadaan_id==$bd->id) selected @endif >{{$bd->pengadaan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Alamat Perusahaan</label>
                                                    <div class="col-lg-8">
                                                        <input disabled type="text" name="alamat" value="{{$data->alamat}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                            <div class="col-md-6">   
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Status Perusahaan</label>
                                                    <div class="col-lg-7">
                                                        <select disabled name="status_vendor_id" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                                                            <option value="">Pilih  --</option>    
                                                            @foreach(get_status_vendor() as $bd)
                                                                <option value="{{$bd->id}}" @if($data->status_vendor_id==$bd->id) selected @endif >{{$bd->status_vendor}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Email Perusahaan</label>
                                                    <div class="col-lg-8">
                                                        <input disabled type="text" name="email" value="{{$data->email}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Telepon  Perusahaan</label>
                                                    <div class="col-lg-4">
                                                        <input disabled type="text" name="telepon" value="{{$data->telepon}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Whatsapp  Perusahaan</label>
                                                    <div class="col-lg-4">
                                                        <input disabled type="text" name="whatsapp" value="{{$data->whatsapp}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right">Fax  Perusahaan</label>
                                                    <div class="col-lg-5">
                                                        <input disabled type="text" name="fax" value="{{$data->fax}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">   
                                                <div class="form-group row">
                                                    <div class="col-lg-1">
                                                        
                                                    </div>
                                                    <div class="col-lg-10 text-center">
                                                        <span id="cektrue" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Selanjutnya</span>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                       
                    </div>
					<div class="tab-pane fade" id="default-tab-2">
                            <div class="panel panel-inverse" data-sortable-id="index-6">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Komoditi</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="show-komoditi"></div>
                                    <!-- <div class="col-md-12">   
                                        <div class="form-group row">
                                            <div class="col-lg-1">
                                                
                                            </div>
                                            <div class="col-lg-10 text-center">
                                                <span id="cekkomoditi" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Selanjutnya</span>
                                            </div>
                                            <div class="col-lg-1">
                                                
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                    </div>
					<div class="tab-pane fade" id="default-tab-3">
                            <div class="panel panel-inverse" data-sortable-id="index-6">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Personil</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="show-personil"></div>
                                    <!-- <div class="col-md-12">   
                                        <div class="form-group row">
                                            <div class="col-lg-1">
                                                
                                            </div>
                                            <div class="col-lg-10 text-center">
                                                <span id="cekpersonil" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Selanjutnya</span>
                                            </div>
                                            <div class="col-lg-1">
                                                
                                            </div>
                                        </div>
                                    </div>   -->
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="default-tab-4">
                            <div class="panel panel-inverse" data-sortable-id="index-6">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Dokumen</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal  form-bordered" id="xx" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div id="show-dokumen"></div>
                                        <!-- <div class="col-md-12">   
                                            <div class="form-group row">
                                                <div class="col-lg-1">
                                                    
                                                </div>
                                                <div class="col-lg-10 text-center">
                                                    <span id="cekdokumen" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Selanjutnya</span>
                                                </div>
                                                <div class="col-lg-1">
                                                    
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        
                                    </form>
                                </div>
                            </div>
                    </div>
					<div class="tab-pane fade" id="default-tab-5">
                            <div class="panel panel-inverse" data-sortable-id="index-6">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">BANK Referensi</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <!-- <span class="btn btn-sm btn-primary" onclick="create_rekening(0)"><i class="fas fa-plus"></i> Tambah Rekening</span> -->
                                    <form class="form-horizontal  form-bordered" id="xx" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div id="show-rekening"></div>
                                        <!-- <div class="col-md-12">   
                                            <div class="form-group row">
                                                <div class="col-lg-1">
                                                    
                                                </div>
                                                <div class="col-lg-10 text-center">
                                                    <span id="cekrekening" class="btn btn-sm btn-success" ><i class="fa fa-arrow-circle-right"></i> Selanjutnya</span>
                                                </div>
                                                <div class="col-lg-1">
                                                    
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        
                                    </form>
                                </div>
                            </div>
                    </div>
					
					
                </div>


                        
				
			
			
			<div class="modal fade" id="modal-rekening" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-university"></i> Form BANK Vendor</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal  form-bordered" id="mydatabank" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                @csrf
								<div id="tampil-form"></div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-bank">Proses</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-personil" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-users"></i> Form Add Personil</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal  form-bordered" id="mydatapersonil" method="post" action="{{ url('vendor/store_personil') }}" enctype="multipart/form-data" >
                                @csrf
								<div id="tampil-personil"></div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-personil">Proses</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-dokumen" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-upload"></i> Form Upload</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal  form-bordered" id="mydatadokumen" method="post" action="{{ url('vendor/store_dokumen') }}" enctype="multipart/form-data" >
                                @csrf
                                <div id="tampil-dokumen"></div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-dokumen">Upload</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-komoditi" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-upload"></i> Upload Lampiran</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" id="mydatakomoditi" method="post" action="{{ url('vendor/store_komoditi') }}" enctype="multipart/form-data" >
                                @csrf
                                <div id="tampil-komoditi"></div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-komoditi">Upload</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="modal-file" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-upload"></i> Perview</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							
                                <div id="tampil-file"></div>
							
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		  
@endsection
@section('script')
    @include('layouts.scripttable')
    @include('layouts.scriptform')
	
@endsection
@push('ajax')
	<script>
        $('#show-rekening').load("{{url('vendors/show_rekening')}}?vendor_id={{$data->id}}&act=1");
        $('#show-personil').load("{{url('vendors/show_personil')}}?vendor_id={{$data->id}}&act=1");
        $('#show-komoditi').load("{{url('vendors/show_komoditi')}}?vendor_id={{$data->id}}&act=1");
        $('#show-dokumen').load("{{url('vendors/show_dokumen')}}?vendor_id={{$data->id}}&act=1");
        $('.default-select2').select2();
		function create_rekening(id){
            
			$('#modal-rekening').modal({backdrop: 'static', keyboard: false});
			$('#tampil-form').load("{{url('vendors/create_rekening')}}?id="+id+"&vendor_id={{$data->id}}");
			

		}
		function create_personil(id){
            
			$('#modal-personil').modal({backdrop: 'static', keyboard: false});
			$('#tampil-personil').load("{{url('vendors/create_personil')}}?id="+id+"&vendor_id={{$data->id}}");
			

		}
		function create_dokumen(id){
            
			$('#modal-dokumen').modal({backdrop: 'static', keyboard: false});
			$('#tampil-dokumen').load("{{url('vendors/create_dokumen')}}?id="+id+"&vendor_id={{$data->id}}");
			

		}
		function create_komoditi(id){
            
			$('#modal-komoditi').modal({backdrop: 'static', keyboard: false});
			$('#tampil-komoditi').load("{{url('vendors/create_komoditi')}}?id="+id+"&vendor_id={{$data->id}}");
			

		}
        
		function show_file(file){
            
			$('#modal-file').modal({backdrop: 'static', keyboard: false});
			$('#tampil-file').html('<iframe src="{{url_plug()}}/file/dokumen/'+file+'" height="400px" width="100%"></iframe>');
			

		}

        $("#cektrue").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vendor/store') }}",
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
                            location.reload();
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

        $("#cekkomoditi").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vendor/store_lanjut_komoditi') }}",
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
                            location.reload();
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

        $("#cekpersonil").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vendor/store_lanjut_personil') }}",
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
                            location.reload();
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

        $("#cekdokumen").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vendor/store_lanjut_dokumen') }}",
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
                            location.reload();
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
        $("#cekrekening").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('vendor/store_lanjut_rekening') }}",
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
                            location.reload();
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
        $("#cekkirim").click(function(e) {
            swal({
               title: "Yakin mengirim pengajuan ini ?",
               text: "",
               type: "warning",
               icon: "info",
               showCancelButton: true,
               align:"center",
               confirmButtonClass: "btn-primary",
               confirmButtonText: "Yes, send it!",
               closeOnConfirm: false
           }).then((willDelete) => {
               if (willDelete) {
                    var form=document.getElementById('mydata');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('vendor/store_lanjut_kirim') }}",
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
                                location.reload();
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
                   
                   
               } else {
                   
               }
           });
                
        });

        $("#save-bank").click(function(e) {
            
            var form=document.getElementById('mydatabank');
            $.ajax({
                type: 'POST',
                url: "{{ url('vendor/store_bank') }}",
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
                        $('#show-rekening').load("{{url('vendors/show_rekening')}}?vendor_id={{$data->id}}");
                        $('#modal-rekening').modal('hide');
                        $('#tampil-form').html("");
			
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

        $("#save-dokumen").click(function(e) {
            
            var form=document.getElementById('mydatadokumen');
            $.ajax({
                type: 'POST',
                url: "{{ url('vendor/store_dokumen') }}",
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
                        $('#show-dokumen').load("{{url('vendors/show_dokumen')}}?vendor_id={{$data->id}}");
                        $('#modal-dokumen').modal('hide');
                        $('#tampil-dokumen').html("");
			
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

        $("#save-komoditi").click(function(e) {
            
            var form=document.getElementById('mydatakomoditi');
            $.ajax({
                type: 'POST',
                url: "{{ url('vendor/store_komoditi') }}",
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
                        $('#show-komoditi').load("{{url('vendors/show_komoditi')}}?vendor_id={{$data->id}}");
                        $('#modal-komoditi').modal('hide');
                        $('#tampil-komoditi').html("");
			
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

        $("#save-personil").click(function(e) {
            
            var form=document.getElementById('mydatapersonil');
            $.ajax({
                type: 'POST',
                url: "{{ url('vendor/store_personil') }}",
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
                        $('#show-personil').load("{{url('vendors/show_personil')}}?vendor_id={{$data->id}}");
                        $('#modal-personil').modal('hide');
                        $('#tampil-personil').html("");
			
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

        function delete_rekening(id){
           
           swal({
               title: "Yakin menhapus data ini ?",
               text: "",
               type: "warning",
               icon: "info",
               showCancelButton: true,
               align:"center",
               confirmButtonClass: "btn-danger",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }).then((willDelete) => {
               if (willDelete) {
                       $.ajax({
                           type: 'GET',
                           url: "{{url('vendors/delete_rekening')}}",
                           data: "id="+id,
                           success: function(msg){
                               swal("Success! berhasil terhapus!", {
                                   icon: "success",
                               });
                               $('#show-rekening').load("{{url('vendors/show_rekening')}}?vendor_id={{$data->id}}");
                           }
                       });
                   
                   
               } else {
                   
               }
           });
           
        }
        function delete_personil(id){
           
           swal({
               title: "Yakin menhapus data ini ?",
               text: "",
               type: "warning",
               icon: "info",
               showCancelButton: true,
               align:"center",
               confirmButtonClass: "btn-danger",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }).then((willDelete) => {
               if (willDelete) {
                       $.ajax({
                           type: 'GET',
                           url: "{{url('vendors/delete_personil')}}",
                           data: "id="+id,
                           success: function(msg){
                               swal("Success! berhasil terhapus!", {
                                   icon: "success",
                               });
                               $('#show-personil').load("{{url('vendors/show_personil')}}?vendor_id={{$data->id}}");
                           }
                       });
                   
                   
               } else {
                   
               }
           });
           
        }
        function delete_komoditi(id){
           
           swal({
               title: "Yakin menghapus data ini ?",
               text: "",
               type: "warning",
               icon: "info",
               showCancelButton: true,
               align:"center",
               confirmButtonClass: "btn-danger",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }).then((willDelete) => {
               if (willDelete) {
                       $.ajax({
                           type: 'GET',
                           url: "{{url('vendors/delete_komoditi')}}",
                           data: "id="+id,
                           success: function(msg){
                               swal("Success! berhasil terhapus!", {
                                   icon: "success",
                               });
                               $('#show-komoditi').load("{{url('vendors/show_komoditi')}}?vendor_id={{$data->id}}");
                           }
                       });
                   
                   
               } else {
                   
               }
           });
           
        }
	</script>
@endpush

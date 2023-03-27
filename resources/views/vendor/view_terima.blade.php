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
                        <p style="font-size:14px;color:#000">
                            {{$data->keterangan_approve}}<br>
                            ({{$data->deskripsi_approve}})
                           
                            
                        </p>
                        @if($data->status_approve==2)
                            <span class="btn btn-sm btn-danger" id="terima-data">Terima Pengajuan</span>
                        @endif
                        @if($data->status_approve==3 || $data->status_approve==10)
                            <span class="btn btn-sm btn-info" onclick="buat_undangan()"><i class="fas fa-envelope"></i> Tentukan Undangan</span>
                        @endif
                        @if($data->status_approve==4)
                        <span class="btn btn-sm btn-blue" onclick="buat_verifikasi()"><i class="fas fa-pencil-alt"></i> Verifikasi Hasil Pemeriksaan</span>
                        <span class="btn btn-sm btn-info" onclick="buat_undangan()"><i class="fas fa-envelope"></i> Ubah Undangan</span>
                        @endif
                        
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
                                        <input type="hidden" name="id" value="{{$id}}">
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


                        
				
			
			
			<div class="modal fade" id="modal-undangan" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-envelope"></i> Form Undangan</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal  form-bordered" id="mydataundangan" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="id" value="{{$id}}">
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tujuan</label>
                                    <div class="col-lg-5">
                                        <input type="text" id="currencysum2" disabled value="{{$data->perusahaan}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Perihal</label>
                                    <div class="col-lg-9">
                                        <input type="text"  value="Verifikasi dokumen calon rekanan" name="perihal" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Pelaksanaan</label>
                                    <div class="col-lg-3">
                                        <input type="text" id="jadwal_verifikasi"  name="jadwal_verifikasi" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-undangan">Proses</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-verifikasi" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-envelope"></i> Form verifikasi</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal  form-bordered" id="mydataverifikasi" method="post" action="{{ url('pendaftaran/store_rekanan') }}" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="id" value="{{$id}}">
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Vendor</label>
                                    <div class="col-lg-5">
                                        <input type="text"  disabled value="{{$data->perusahaan}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Badan Usaha</label>
                                    <div class="col-lg-8">
                                        <input type="text"  disabled value="{{$data->badan_usaha}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Status Verifikasi</label>
                                    <div class="col-lg-5">
                                        <select name="status" onchange="pilih_status(this.value)" class="form-control form-control-sm" placeholder="ketik disini...">
                                            <option value="">Pilih---</option>
                                            <option value="1">Terima </option>
                                            <option value="2">Kembalikan Dokumen </option>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group row" id="alasan-verifikasi">
                                    <label class="col-lg-3 col-form-label">Alasan Pengembalian</label>
                                    <div class="col-lg-8">
                                        <textarea   name="alasan" rows="4" class="form-control form-control-sm" placeholder="ketik disini..."></textarea>
                                    </div>
                                </div>
							</form>
						</div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Batal</a>
							<a href="javascript:;" class="btn btn-primary" id="save-verifikasi">Proses</a>
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
        $('#jadwal_verifikasi').datetimepicker({format:"Y-MM-DD HH:mm:ss"});
        $('.default-select2').select2();
        $('#alasan-verifikasi').hide();
    
        function pilih_status(id){
            if(id==2){
                $('#alasan-verifikasi').show();
            }else{
                $('#alasan-verifikasi').hide();
            }
        }
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
        
		function buat_undangan(){
            
			$('#modal-undangan').modal({backdrop: 'static', keyboard: false});
		}
		function buat_verifikasi(){
            
			$('#modal-verifikasi').modal({backdrop: 'static', keyboard: false});
		}
        function show_file(file){
            
			$('#modal-file').modal({backdrop: 'static', keyboard: false});
			$('#tampil-file').html('<iframe src="{{url_plug()}}/file/dokumen/'+file+'" height="400px" width="100%"></iframe>');
			

		}
        $("#save-undangan").click(function(e) {
            swal({
               title: "Yakin untuk mengirim undangan ke {{$data->perusahaan}} ?",
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
                        var form=document.getElementById('mydataundangan');
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('vendors/store_undangan') }}",
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

        $("#save-verifikasi").click(function(e) {
            swal({
               title: "Yakin untuk memberikan hasil verifikasi ?",
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
                        var form=document.getElementById('mydataverifikasi');
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('vendors/store_verifikasi') }}",
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
                                    location.assign("{{url('vendors/pengajuan')}}");
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

        $("#terima-data").click(function(e) {
            swal({
               title: "Yakin untuk menerima pengajuan ini ?",
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
                        url: "{{ url('vendors/store_lanjut_terima') }}",
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
	</script>
@endpush

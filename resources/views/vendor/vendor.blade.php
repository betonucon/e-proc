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
                var tables=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('vendors/get_data_rekanan')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'perusahaan' },
						{ data: 'singkatan_badan_usaha' },
						{ data: 'pengadaan' },
						{ data: 'alamat' },
						{ data: 'waktu_kirim' },
						{ data: 'action' },
						
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
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Vendor</li>
    </ol>
    <h1 class="page-header">Vendor <small></small></h1>
    
    <div class="row" id="show-dashboard-rekanan">
       
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title"></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="tampil_dashboard"></div>
            <div class="table-responsive ">
                <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap" width="20%">Vendor</th>
                            <th class="text-nowrap" width="10%">Badan</th>
                            <th class="text-nowrap" width="20%">Pengadaan</th>
                            <th class="text-nowrap" >Alamat</th>
                            <th class="text-nowrap" width="12%">diajukan</th>
                            <th class="text-nowrap" width="8%">Act</th>
                        </tr>
                    </thead>
                    
                </table>
           
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Absensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notnotifikasiabsen">
                    <div id="notifikasiabsen"></div>
                    
                </div>
                
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/jabatan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div id="tampil-form"></div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="btn-save" >Proses</a>
            </div>
        </div>
    </div>
</div>           
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Tanggal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" id="tanggal_cari" class="form-control" />
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="import-data" >Proses</a>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="modal-download" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Tanggal Download</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" id="tanggal_cari2" class="form-control" />
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="download-data" >Proses</a>
            </div>
        </div>
    </div>
</div>          
@endsection

@section('script')
    @include('layouts.scripttable')
    @include('layouts.scriptform')
    <style>
        
    </style>
@endsection


@push('ajax')
   <script>
        $('#show-dashboard-rekanan').load("{{url('vendors/show_dashboard_rekanan')}}");
        
        function pilih_status(id){
            var tables=$('#data-table-fixed-header').DataTable();
                tables.ajax.url("{{ url('vendors/get_data_rekanan')}}?status_approve="+id).load();
        }
   </script>
@endpush

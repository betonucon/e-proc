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
                    responsive: false,
                    ajax:"{{ url('master/komoditi/get_data')}}?tanggal=",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
                        { data: 'action' },
						{ data: 'jenis' },
						{ data: 'nama_komoditi' },
						{ data: 'deskripsi_komoditi' },
						
						
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
        <li class="breadcrumb-item active">Komoditi</li>
    </ol>
    <h1 class="page-header">Komoditi <small></small></h1>
    
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-sm btn-success" onclick="view_data(`{{encoder(0)}}`)"><i class="fas fa-plus"></i> Tambah </button>
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
            <div class="table-responsive ">
                <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap" width="8%"></th>
                            <th class="text-nowrap" width="12%">Tipe Komoditi</th>
                            <th class="text-nowrap" width="30%">Komoditi</th>
                            <th class="text-nowrap" >Deskripsi</th>
                        </tr>
                    </thead>
                    
                </table>
           
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Komoditi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/komoditi') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div id="tampil-form"></div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="save-data" >Proses</a>
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
        function view_data(id){
            
			$('#modal-form').modal({backdrop: 'static', keyboard: false});
			$('#tampil-form').load("{{url('master/komoditi/view')}}?id="+id);
			

		}
        function pilih_status(id){
            var tables=$('#data-table-fixed-header').DataTable();
                tables.ajax.url("{{ url('vendors/get_data')}}?status_approve="+id).load();
        }

        $("#save-data").click(function(e) {
                
                var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('master/komoditi/store') }}",
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
                            $('#modal-form').modal('hide');
			                $('#tampil-form').html("");
                            var tables=$('#data-table-fixed-header').DataTable();
                                tables.ajax.url("{{ url('master/komoditi/get_data')}}").load();
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

        function delete_data(id){
           
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
                           url: "{{url('master/komoditi/delete')}}",
                           data: "id="+id,
                           success: function(msg){
                               swal("Success! berhasil terhapus!", {
                                   icon: "success",
                               });
                               var tables=$('#data-table-fixed-header').DataTable();
                                tables.ajax.url("{{ url('master/komoditi/get_data')}}").load();
                           }
                       });
                   
                   
               } else {
                   
               }
           });
           
        }
   </script>
@endpush

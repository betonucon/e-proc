@extends('layouts.app')

@section('content')
        <div id="content" class="content">
			
			<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h4 class="panel-title">&nbsp;</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal form-bordered">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5 class="text-blue">Pendaftaran</h5>
                                        Silahkan pilih tujuan pendaftaran
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6" onclick="location.assign(`{{url('pendaftaran/rekanan')}}`)">
                                        <div class="alert alert-yellow fade show m-b-10 text-center">
                                            <i class="fas fa-id-card fa-5x"></i>
                                            <h5 class="text-blue">Rekanan</h5>
                                            Daftar sebagai rekanan
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="alert alert-aqua fade show m-b-10 text-center">
                                            <i class="fas fa-briefcase fa-5x"></i>
                                            <h5 class="text-blue">Pengadaan</h5>
                                            Daftar sebagai rekanan
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                
			<!-- end panel -->
		</div>
@endsection

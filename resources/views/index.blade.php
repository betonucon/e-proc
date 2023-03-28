@extends('layouts.app')

@section('content')
        <div id="content" class="content">
			<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10">
					<ol class="breadcrumb float-xl-right">
						<li class="breadcrumb-item active">Home</li>
					</ol>
					<h1 class="page-header">Home <small>E-Procurement PT KPDP</small></h1>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-body" style="padding: 3px;">
									<img src="{{url_plug()}}/img/kpdp.jpeg" width="100%" height="200px">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel">
								<div class="panel-body text-center ">
									<span class="fa-stack fa-2x fa-4x text-aqua">
										<i class="far fa-circle fa-stack-2x"></i>
										<i class="fa fa-clone fa-stack-1x"></i>
									</span><br><br>
									<h5>Panduan Pengguna</h5>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel">
								<div class="panel-body text-center ">
									<span class="fa-stack fa-2x fa-4x text-aqua">
										<i class="far fa-circle fa-stack-2x"></i>
										<i class="fa fa-question fa-stack-1x"></i>
									</span><br><br>
									<h5>Faq</h5>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel">
								<div class="panel-body text-center ">
									<span class="fa-stack fa-2x fa-4x text-aqua">
										<i class="far fa-circle fa-stack-2x"></i>
										<i class="fa fa-info fa-stack-1x"></i>
									</span><br><br>
									<h5>Kebijakan</h5>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel">
								<div class="panel-body text-center ">
									<span class="fa-stack fa-2x fa-4x text-aqua">
										<i class="far fa-circle fa-stack-2x"></i>
										<i class="fa fa-phone fa-stack-1x"></i>
									</span><br><br>
									<h5>Hubungi Kami</h5>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
				<div class="col-md-1">

				</div>
			</div>
			<!-- end panel -->
		</div>
@endsection


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>E-Procurement</title>
	<link rel="icon" href="{{url_plug()}}/img/fav.png">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            font-size: .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #333;
            text-align: left;
            background-color: #d9e0e7;
        }
		
        .header.navbar-inverse {
            background: #220d62;
        }
        .top-menu .nav>li {
            position: relative;
            border-right: solid 1px #6e6e95;
            display: block;
        }
        .top-menu .nav>li>a {
            padding: 5px 20px;
            color: rgb(255 255 255);
            line-height: 20px;
            text-decoration: none;
            white-space: nowrap;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
        }
        .form-horizontal.form-bordered .form-group>div {
			padding: 6px;
		}
        .swal-text {
            width: 100%;
            color: #000;
        }
		.form-horizontal.form-bordered .form-group .col-form-label {
    		padding: 5px 15px;
			vertical-align:top;
		}
        a {
            color: #fff;
            text-decoration: none;
            background-color: transparent;
        }
        @media (min-width: 768px){
            .top-menu {
                top: 50px;
                position: fixed;
                height: 30px;
            }
        }
        .top-menu .nav .sub-menu {
            display: none;
            top: 30px;
            background: #200464;
            list-style-type: none;
            margin: 0;
            padding: 10px 0;
        }
		.header .navbar-brand {
			padding: 10px 20px;
			height: 70px;
			font-weight: 100;
			font-size: 18px;
			line-height: 30px;
			text-decoration: none;
			-webkit-box-flex: 1;
			-ms-flex: 1;
			flex: 1;
			-ms-flex-align: center;
			align-items: center;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
		}
		@media (min-width: 768px){
			.top-menu {
				top: 70px;
				position: fixed;
				height: 30px;
			}
		}
        .loadpage {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1070;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgb(218 219 223);
            overflow-x: hidden;
            transition: transform .9s;
        }
        .loadpage-content {
            position: relative;
            top: 25%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            color:#fff;
            font-size:20px;
        }
        .loadnya {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1070;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgb(243 230 230 / 81%);
            overflow-x: hidden;
            transition: transform .9s;
        }
        .loadnya-content {
            position: relative;
            top: 25%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            color:#fff;
            font-size:20px;
        }
    </style>
</head>
<body>
    <div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
            <button class="btn btn-light" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
    </div>
    <div id="loadpage" class="loadpage">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadpage-content">
            
                <img src="{{url_plug()}}/img/loading.gif" width="5%">
            
        </div>
    </div>
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
		<!-- begin #header -->
		<div id="header" class="header navbar-inverse">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><img src="{{url_plug()}}/img/logo.png" width="100%"></a>
				<button type="button" class="navbar-toggle" data-click="top-menu-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<!-- <ul class="navbar-nav navbar-right">
				
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{url_plug()}}/assets/img/user/user-13.jpg" alt="" /> 
						<span class="d-none d-md-inline">Adam Schwartz</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
						<a href="javascript:;" class="dropdown-item">Calendar</a>
						<a href="javascript:;" class="dropdown-item">Setting</a>
						<div class="dropdown-divider"></div>
						<a href="javascript:;" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul> -->
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #top-menu -->
		<div id="top-menu" class="top-menu">
			<!-- begin nav -->
			<ul class="nav" style="background: #11115a;">
				<li>
					<a href="widget.html">
						<span>Home</span> 
					</a>
				</li>
				<li>
					<a href="widget.html">
						<span>Pengumuman Lelang</span> 
					</a>
				</li>
				
				<li class="menu-control menu-control-left">
					<a href="javascript:;" data-click="prev-menu"><i class="fa fa-angle-left"></i></a>
				</li>
				<li class="menu-control menu-control-right">
					<a href="javascript:;" data-click="next-menu"><i class="fa fa-angle-right"></i></a>
				</li>
			</ul>
			<!-- end nav -->
		</div>
		<!-- end #top-menu -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
    <script src="{{url_plug()}}/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
	<!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
       
		function load(){
			document.getElementById("loadpage").style.width = "100%";
		}
		function close_load(){
			document.getElementById("loadpage").style.width = "0%";
		}
		$(document).ready(function() {
			
			load();
		});
		
		window.setTimeout(function () {
			document.getElementById("loadpage").style.width = "0%";
		}, 1000);
    </script>
    @stack('ajax')
</body>
</html>
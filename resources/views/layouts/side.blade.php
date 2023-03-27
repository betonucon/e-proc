
			@if(Auth::user()->role_id==1)
				<li class="has-sub @if(Request::is('home')==1 || Request::is('/')==1) active @endif">
					<a href="{{url('home')}}"  class="text-white">
						<i class="fas fa-home text-white"></i> 
						<span>Home</span>
					</a>
				</li>
				<li class="has-sub @if(Request::is('master/*')==1) active @endif">
					<a href="javascript:;" class="text-white">
						<b class="caret"></b>
						<i class="fas fa-archive text-white"></i>
						<span>Master Data </span>
					</a>
					<ul class="sub-menu" @if(Request::is('master/*')==1) style="display: block;" @endif>
						<li><a href="{{url('master/komoditi')}}" >komoditi </a></li>
						<li><a href="{{url('master/jabatan')}}">Jabatan</a></li>
					</ul>
				</li>
				<li class="has-sub @if(Request::is('vendors/*')==1) active @endif">
					<a href="{{url('vendors/pengajuan')}}"  class="text-white">
						<i class="fas fa-users text-white"></i> 
						<span>Pengajuan Rekanan </span>
					</a>
				</li>
				<li class="has-sub @if(Request::is('vendors')==1) active @endif">
					<a href="{{url('vendors')}}"  class="text-white">
						<i class="fas fa-users text-white"></i> 
						<span>Vendor </span>
					</a>
				</li>
				
			@endif
			@if(Auth::user()->role_id==5)
				<li class="has-sub @if(Request::is('home')==1 || Request::is('/')==1) active @endif">
					<a href="{{url('home')}}"  class="text-white">
						<i class="fas fa-home text-white"></i> 
						<span>Proses rekanan</span>
					</a>
				</li>
			
			@endif
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left text-white"></i></a></li>
					
				
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\User;
use App\Models\MSvendor;
use App\Models\VMSvendor;
use App\Models\MSdokumen;
use App\Models\MSkomoditi;
use App\Models\MSvendorrekening;
use App\Models\MSvendorkomoditi;
use App\Models\MSvendorpersonil;
use App\Models\MSvendordokumen;
use App\Models\VMSvendorrekening;
use App\Models\VMSvendorpersonil;
class VendorController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        return view('vendor.index',compact('template'));
    }
    public function vendor(request $request)
    {
        error_reporting(0);
        $template='top';
        return view('vendor.vendor',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        
        $id=decoder($request->id);
        $data=VMSvendor::where('id',$id)->first();
        if($id==0){
            $step=1;
            $readonly="";
        }else{
            $step=$data->status;
            $readonly="readonly";
        }
        
        $template='top';
        return view('vendor.create',compact('template','id','data','step','readonly'));
        
        
    }
    public function view(request $request)
    {
        error_reporting(0);
        
        $id=decoder($request->id);
        $data=VMSvendor::where('id',$id)->first();
        $template='top';
        if($data->status_approve==2 || $data->status_approve==10 || $data->status_approve==3 || $data->status_approve==4){
            return view('vendor.view_terima',compact('template','id','data'));
        }else{
            return view('vendor.view',compact('template','id','data'));
        }
        
    }
    public function create_rekening(request $request)
    {
        error_reporting(0);
        
        $id=$request->id;
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data=MSvendorrekening::where('id',$request->id)->first();
        if($request->id==0){
            $pemilik=$mst->perusahaan;
        }else{
            $pemilik=$data->pemilik;
        }
        $template='top';
        return view('vendor.create_rekening',compact('template','id','data','mst','pemilik'));
    }
    public function create_personil(request $request)
    {
        error_reporting(0);
        
        $id=$request->id;
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data=MSvendorpersonil::where('id',$request->id)->first();
        if($request->id==0){
            $pemilik=$mst->perusahaan;
        }else{
            $pemilik=$data->pemilik;
        }
        $template='top';
        return view('vendor.create_personil',compact('template','id','data','mst','pemilik'));
    }

    public function create_dokumen(request $request)
    {
        error_reporting(0);
        
        $id=$request->id;
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data=MSdokumen::where('id',$request->id)->first();
        
        $template='top';
        return view('vendor.create_dokumen',compact('template','id','data','mst'));
    }

    public function create_komoditi(request $request)
    {
        error_reporting(0);
        
        $id=$request->id;
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data=MSkomoditi::where('id',$request->id)->first();
        
        $template='top';
        return view('vendor.create_komoditi',compact('template','id','data','mst'));
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = VMSvendor::query();
        if($request->status_approve!=""){
            $data = $query->where('status_approve',$request->status_approve);
        }else{
            $data = $query->whereIn('status_approve',array(2,3,4,10));
        }
        
        $data = $query->orderBy('id','Desc')->get();

        return Datatables::of($data)
            ->addColumn('seleksi', function ($row) {
                $btn='<span class="btn btn-success btn-xs" onclick="pilih_cost(`'.$row->cost_center.'`,`'.$row->customer_code.'`,`'.$row->customer.'`,`'.$row->deskripsi_project.'`)">Pilih</span>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                
                    $btn='<span class="btn btn-info btn-xs" onclick="location.assign(`'.url('vendors/view?id='.encoder($row->id)).'`)">View</span>';
               
                return $btn;
            })
            
            
            ->rawColumns(['action','seleksi'])
            ->make(true);
    }
    public function get_data_rekanan(request $request)
    {
        error_reporting(0);
        $query = VMSvendor::query();
        if($request->status_approve!=""){
           
        }else{
           
        }
        
        $data = $query->where('status_approve',5)->orderBy('id','Desc')->get();

        return Datatables::of($data)
            ->addColumn('seleksi', function ($row) {
                $btn='<span class="btn btn-success btn-xs" onclick="pilih_cost(`'.$row->cost_center.'`,`'.$row->customer_code.'`,`'.$row->customer.'`,`'.$row->deskripsi_project.'`)">Pilih</span>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                
                    $btn='<span class="btn btn-info btn-xs" onclick="location.assign(`'.url('vendors/view?id='.encoder($row->id)).'`)">View</span>';
               
                return $btn;
            })
            
            
            ->rawColumns(['action','seleksi'])
            ->make(true);
    }

    public function show_rekening(request $request)
    {
        error_reporting(0);
        $data="";
        $get=VMSvendorrekening::where('vendor_id',$request->vendor_id)->get();
        if($request->act==1){
            $data.='<table class="table table-striped">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="10%">BANK</th>
                    <th width="20%">Atas Nama</th>
                    <th width="15%">No Rekening</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>';
            foreach($get as $no=>$o){
                $data.='<tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o->bank.'</td>
                            <td>'.$o->pemilik.'</td>
                            <td>'.$o->no_rekening.'</td>
                            <td>'.$o->cabang.' , '.$o->alamat_bank.'</td>
                        </tr>';
            }
            $data.='</table>';
            return $data;
        }else{
            $data.='<table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="10%"></th>
                                <th width="10%">BANK</th>
                                <th width="20%">Atas Nama</th>
                                <th width="15%">No Rekening</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach($get as $no=>$o){
                $data.='<tr>
                            <td>'.($no+1).'</td>
                            <td>
                                <span class="btn btn-xs btn-primary" onclick="create_rekening('.$o->id.')"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                <span class="btn btn-xs btn-danger" onclick="delete_rekening('.$o->id.')"><i class="fas fa-window-close fa-fw"></i></span>
                            </td>
                            <td>'.$o->bank.'</td>
                            <td>'.$o->pemilik.'</td>
                            <td>'.$o->no_rekening.'</td>
                            <td>'.$o->cabang.' , '.$o->alamat_bank.'</td>
                        </tr>';
            }
            $data.='</table>';
            return $data;
        }
    }
    public function show_dashboard(request $request)
    {
        error_reporting(0);
        $data="";
        foreach(get_status_approve_admin() as $sts){
            $data.='<div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-'.$sts->color.'">
                            <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                            <div class="stats-info">
                                <h4 style="text-transform:uppercase">'.$sts->status_approve_admin.'</h4>
                                <p>'.count_status_approve($sts->id).'</p>	
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;" onclick="pilih_status('.$sts->id.')">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                            </div>
                        </div>
                    </div>';
        }
        return $data;
    }
    public function show_dashboard_rekanan(request $request)
    {
        error_reporting(0);
        $data="";
        $data.='<div class="col-xl-4 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title" style="text-transform:uppercase">TOTAL VENDOR</div>
                    <div class="stats-number">'.count_pengadaan(0).'</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-desc">Better than last week (100%)</div>
                </div>
            </div>
        </div>
        ';
        foreach(get_pengadaan_admin() as $sts){
            $data.='<div class="col-xl-4 col-md-6">
                        <div class="widget widget-stats bg-'.$sts->background.'">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title" style="text-transform:uppercase">'.$sts->pengadaan.'</div>
                                <div class="stats-number">'.count_pengadaan($sts->id).'</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: '.persen_pengadaan($sts->id).'%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week ('.persen_pengadaan($sts->id).'%)</div>
                            </div>
                        </div>
                    </div>
                    ';
        }
        return $data;
    }

    public function show_dokumen(request $request)
    {
        error_reporting(0);
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data="";
        if($request->act==1){
            $data.='<table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="35%">Dokumen</th>
                                <th width="15%">Tipe</th>
                                <th >File Lampiran</th>
                                <th width="15%">Berlaku</th>
                            </tr>
                        </thead>
                        ';
            foreach(get_dokumen($mst->pengadaan_id) as $no=>$o){
                $data.='<tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o->nama_dokumen.'</td>
                            <td>'.$o->extension.'</td>';
                            if(count_dokumen($o->id,$request->vendor_id)!=""){
                                $data.='<td><a href="#" onclick="show_file(`'.count_dokumen($o->id,$request->vendor_id).'`)">'.linknya($mst->perusahaan).'/'.$o->kode_dokumen.'/'.count_dokumen($o->id,$request->vendor_id).'</a></td>';
                                $data.='<td>'.berlaku_dokumen($o->id,$request->vendor_id).'</td>';
                            }else{
                                $data.='<td></td>';
                                $data.='<td></td>';
                            }
                            $data.='
                        </tr>';
            }
            $data.='</table>';
        }else{
            $data.='<table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="4%"></th>
                                <th width="35%">Dokumen</th>
                                <th width="15%">Tipe</th>
                                <th >File Lampiran</th>
                                <th width="10%">Berlaku</th>
                            </tr>
                        </thead>
                        ';
            foreach(get_dokumen($mst->pengadaan_id) as $no=>$o){
                if(total_waktu_dokumen($o->id,$request->vendor_id)>0 ){
                    $col='';
                }else{
                    if(count_dokumen($o->id,$request->vendor_id)!=""){
                        $col='red';
                    }else{
                        $col='';
                    }
                    
                }
                $data.='<tr bgcolor="'.$col.'">
                            <td>'.($no+1).'</td>
                            <td>
                                <div class="btn-group">
                                    <span class="btn btn-xs btn-primary" onclick="create_dokumen('.$o->id.')"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                </div>
                            </td>
                            <td>'.$o->nama_dokumen.'</td>
                            <td>'.$o->extension.'</td>';
                            if(count_dokumen($o->id,$request->vendor_id)!=""){
                                $data.='<td><a href="#" onclick="show_file(`'.count_dokumen($o->id,$request->vendor_id).'`)">'.linknya($mst->perusahaan).'/'.$o->kode_dokumen.'/'.count_dokumen($o->id,$request->vendor_id).'</a></td>';
                                $data.='<td>'.berlaku_dokumen($o->id,$request->vendor_id).'</td>';
                            }else{
                                $data.='<td></td>';
                                $data.='<td></td>';
                            }
                            $data.='
                        </tr>';
            }
            $data.='</table>';
        }
        return $data;
    }

    public function show_personil(request $request)
    {
        error_reporting(0);
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $get=VMSvendorpersonil::where('vendor_id',$request->vendor_id)->get();
        $data="";
        if($request->act==1){
            $data.='<table width="120%" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="2%">NO</th>
                                <th width="20%">Nama</th>
                                <th width="11%">NO KTP</th>
                                <th >Alamat</th>
                                <th width="11%">Jabatan</th>
                                <th width="11%">Ttgl</th>
                            </tr>
                        </thead>
                        ';
            foreach($get as $no=>$o){
                $data.='<tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o->nama.'</td>
                            <td>'.$o->nik.'</td>
                            <td>'.$o->alamat.'</td>
                            <td>'.$o->jabatan.'</td>
                            <td>'.$o->tempat_lahir.', '.$o->tgl_lahir.'</td>
                            
                        </tr>';
            }
            $data.='</table>';

        }else{
            $data.='<table width="120%" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="2%">NO</th>
                                <th width="6%"></th>
                                <th width="20%">Nama</th>
                                <th width="11%">NO KTP</th>
                                <th >Alamat</th>
                                <th width="11%">Jabatan</th>
                                <th width="11%">Ttgl</th>
                            </tr>
                        </thead>
                        ';
            foreach($get as $no=>$o){
                $data.='<tr>
                            <td>'.($no+1).'</td>
                            <td>
                                <div class="btn-group">
                                    <span class="btn btn-xs btn-primary" onclick="create_personil('.$o->id.')"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                    <span class="btn btn-xs btn-danger" onclick="delete_personil('.$o->id.')"><i class="fas fa-window-close fa-fw"></i></span>
                                </div>
                            </td>
                            <td>'.$o->nama.'</td>
                            <td>'.$o->nik.'</td>
                            <td>'.$o->alamat.'</td>
                            <td>'.$o->jabatan.'</td>
                            <td>'.$o->tempat_lahir.', '.$o->tgl_lahir.'</td>
                            
                        </tr>';
            }
            $data.='</table>';
        }
        return $data;
    }

    public function show_komoditi(request $request)
    {
        error_reporting(0);
        $mst=VMSvendor::where('id',$request->vendor_id)->first();
        $data="";
        if($request->act==1){
            $data.='<h6 class="panel-title">Komoditi Terpilih</h6>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">Kode</th>
                                    <th>Nama Komoditi</th>
                                    <th width="15%">Status</th>
                                    <th width="5%"></th>
                                    
                                </tr>
                            </thead>
                        ';
                foreach(get_view_komoditi($request->vendor_id) as $no=>$o){
                    $data.='<tr>
                                <td>'.$o->kode_komoditi.'</td>
                                <td>'.$o->nama_komoditi.'</td>
                                <td>'.$o->status_vendor.'</td>
                                <td>
                                    <div class="btn-group">
                                        <span class="btn btn-xs btn-warning" title="'.$o->file_komoditi.'" onclick="show_file(`'.$o->file_komoditi.'`)"><i class="fas fa-clone"></i></span>
                                    </div>
                                </td>
                                
                                
                            </tr>';
                }
                $data.='</table>';
        }else{
            $data='<div class="row">';
                $data.='<div class="col-md-5">
                            <h6 class="panel-title">Pilih Komoditi</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="15%">Kode</th>
                                        <th>Nama Komoditi</th>
                                        <th width="20%"></th>
                                        
                                    </tr>
                                </thead>
                            ';
                foreach(get_komoditi($mst->pengadaan_id) as $no=>$o){
                    if(cek_view_komoditi($request->vendor_id,$o->id)==0){
                    $data.='<tr>
                                <td>'.$o->kode_komoditi.'</td>
                                <td>'.$o->nama_komoditi.'</td>
                                <td>
                                        <div class="btn-group">
                                            <span class="btn btn-xs btn-primary" onclick="create_komoditi('.$o->id.')"><i class="fas fa-arrow-alt-circle-right fa-flip-vertical"></i> Pilih</span>
                                        </div>
                                </td>
                                
                            </tr>';
                    }
                }
                $data.='</table></div>';
                $data.='<div class="col-md-7">
                            <h6 class="panel-title">Komoditi Terpilih</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="15%">Kode</th>
                                        <th>Nama Komoditi</th>
                                        <th width="15%">Status</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                        
                                    </tr>
                                </thead>
                            ';
                foreach(get_view_komoditi($request->vendor_id) as $no=>$o){
                    $data.='<tr>
                                <td>'.$o->kode_komoditi.'</td>
                                <td>'.$o->nama_komoditi.'</td>
                                <td>'.$o->status_vendor.'</td>
                                <td>
                                    <div class="btn-group">
                                        <span class="btn btn-xs btn-warning" title="'.$o->file_komoditi.'" onclick="show_file(`'.$o->file_komoditi.'`)"><i class="fas fa-clone"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <span class="btn btn-xs btn-danger" onclick="delete_komoditi('.$o->id.')"><i class="fas fa-window-close"></i></span>
                                    </div>
                                </td>
                                
                            </tr>';
                }
                $data.='</table></div>';
                $data.='</div>';
        }
        return $data;
    }

    public function delete_rekening(request $request){
        $data=MSvendorrekening::where('id',$request->id)->delete();
    }

    public function delete_komoditi(request $request){
        $data=MSvendorkomoditi::where('id',$request->id)->delete();
    }

    public function delete_personil(request $request){
        $data=MSvendorpersonil::where('id',$request->id)->delete();
    }

    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        

        $rules['negara_id']= 'required';
        $messages['negara_id.required']= 'Silahkan isi kolom negara ';

        $rules['status_perusahaan_id']= 'required';
        $messages['status_perusahaan_id.required']= 'Silahkan pilih status pemodalan ';

        $rules['pengadaan_id']= 'required';
        $messages['pengadaan_id.required']= 'Silahkan pilih jenis pengadaan ';

        $rules['status_vendor_id']= 'required';
        $messages['status_vendor_id.required']= 'Silahkan pilih status perusahaan ';
        
        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Silahkan isi kolom alamat ';

        $rules['email']= 'required|email';
        $messages['email.required']= 'Silahkan isi nama email ';
        $messages['email.email']= 'Format email salah ';

        $rules['telepon']= 'required|numeric';
        $messages['telepon.required']= 'Silahkan isi kolom telepon ';
        $messages['telepon.numeric']= 'Format telepon harus angka ';

        $rules['whatsapp']= 'required|numeric';
        $messages['whatsapp.required']= 'Silahkan isi kolom whatsapp ';
        $messages['whatsapp.numeric']= 'Format whatsapp harus angka ';

        $rules['fax']= 'required|numeric';
        $messages['fax.required']= 'Silahkan isi kolom fax ';
        $messages['fax.numeric']= 'Format fax harus angka ';
       
        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            if($mst->status==1){
                $status=2;
            }else{
                $status=$mst->status;
            }
            $vendor=MSvendor::where('users_id',Auth::user()->id)->update([
                    'alamat'=>$request->alamat,
                    'negara_id'=>$request->negara_id,
                    'status_perusahaan_id'=>$request->status_perusahaan_id,
                    'pengadaan_id'=>$request->pengadaan_id,
                    'status_vendor_id'=>$request->status_vendor_id,
                    'email'=>$request->email,
                    'telepon'=>$request->telepon,
                    'whatsapp'=>$request->whatsapp,
                    'fax'=>$request->fax,
                    'status'=>$status,
                    'status_profil'=>1,
                    'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
            
        }
    }

    public function store_create(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        

        $rules['npwp']= 'required|numeric';
        $messages['npwp.required']= 'Silahkan isi kolom NPWP ';
        $messages['npwp.numeric']= 'Format NPWP harus angka';

        $rules['badan_usaha_id']= 'required|numeric';
        $messages['badan_usaha_id.required']= 'Silahkan isi kolom badan usaha ';
        $messages['badan_usaha_id.numeric']= 'Format badan usaha harus angka';

        $rules['perusahaan']= 'required';
        $messages['perusahaan.required']= 'Silahkan isi kolom nama perusahaan ';
        
        $rules['negara_id']= 'required';
        $messages['negara_id.required']= 'Silahkan isi kolom negara ';

        $rules['status_perusahaan_id']= 'required';
        $messages['status_perusahaan_id.required']= 'Silahkan pilih status pemodalan ';

        $rules['pengadaan_id']= 'required';
        $messages['pengadaan_id.required']= 'Silahkan pilih jenis pengadaan ';

        $rules['status_vendor_id']= 'required';
        $messages['status_vendor_id.required']= 'Silahkan pilih status perusahaan ';
        
        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Silahkan isi kolom alamat ';

        $rules['email']= 'required|email|unique:users';
        $messages['email.required']= 'Silahkan isi nama email ';
        $messages['email.email']= 'Format email salah ';
        $messages['email.unique']= 'Email sudah terdaftar ';

        $rules['telepon']= 'required|numeric';
        $messages['telepon.required']= 'Silahkan isi kolom telepon ';
        $messages['telepon.numeric']= 'Format telepon harus angka ';

        $rules['whatsapp']= 'required|numeric';
        $messages['whatsapp.required']= 'Silahkan isi kolom whatsapp ';
        $messages['whatsapp.numeric']= 'Format whatsapp harus angka ';

        $rules['fax']= 'required|numeric';
        $messages['fax.required']= 'Silahkan isi kolom fax ';
        $messages['fax.numeric']= 'Format fax harus angka ';
       
        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            $data=User::create([
                    'name'=>$request->perusahaan,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'username'=>$request->email,
                    'role_id'=>5,
                    'active'=>1,
            ]);

            $vendor=MSvendor::create([
                    'npwp'=>$request->npwp,
                    'perusahaan'=>$request->perusahaan,
                    'alamat'=>$request->alamat,
                    'users_id'=>$data->id,
                    'badan_usaha_id'=>$request->badan_usaha_id,
                    'negara_id'=>$request->negara_id,
                    'status_perusahaan_id'=>$request->status_perusahaan_id,
                    'pengadaan_id'=>$request->pengadaan_id,
                    'status_vendor_id'=>$request->status_vendor_id,
                    'email'=>$request->email,
                    'telepon'=>$request->telepon,
                    'whatsapp'=>$request->whatsapp,
                    'fax'=>$request->fax,
                    'status_approve'=>1,
                    'status'=>2,
                    'status_profil'=>1,
                    'created_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok@'.encoder($vendor->id);
            
        }
    }

    public function store_lanjut_komoditi(request $request){
        error_reporting(0);
            if(Auth::user()->role_id==5){
                $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            }else{
                $mst=MSvendor::where('id',$request->vendor_id)->first();
            }
            
            if($mst->status==2){
                $status=3;
            }else{
                $status=$mst->status;
            }
            if(cek_komoditi($mst->id)>0){
                $vendor=MSvendor::where('id',$mst->id)->update([
                    'status'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Tentukan komoditi</div></div>';
            }
                
                
       
    }

    public function store_lanjut_personil(request $request){
        error_reporting(0);
        
            if(Auth::user()->role_id==5){
                $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            }else{
                $mst=MSvendor::where('id',$request->vendor_id)->first();
            }
            if($mst->status==3){
                $status=4;
            }else{
                $status=$mst->status;
            }
            if(cek_personil($mst->id)>0){
                $vendor=MSvendor::where('id',$mst->id)->update([
                    'status'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Tentukan komoditi</div></div>';
            }
                
                
       
    }

    public function store_lanjut_dokumen(request $request){
        error_reporting(0);
            if(Auth::user()->role_id==5){
                $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            }else{
                $mst=MSvendor::where('id',$request->vendor_id)->first();
            }
            if($mst->status==4){
                $status=5;
            }else{
                $status=$mst->status;
            }
            if(cek_dokumen($mst->id,$mst->pengadaan_id)>0){
                $vendor=MSvendor::where('id',$mst->id)->update([
                    'status'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Lengkapi dokumen </div></div>';
            }
                
                
       
    }

    public function store_lanjut_rekening(request $request){
        error_reporting(0);
        
            if(Auth::user()->role_id==5){
                $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            }else{
                $mst=MSvendor::where('id',$request->vendor_id)->first();
            }
            if($mst->status==5){
                $status=6;
            }else{
                $status=$mst->status;
            }
            if(cek_dokumen($mst->id,$mst->pengadaan_id)>0){
                $vendor=MSvendor::where('id',$mst->id)->update([
                    'status'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Lengkapi dokumen </div></div>';
            }
                
                
       
    }

    public function store_lanjut_kirim(request $request){
        error_reporting(0);
        
            if(Auth::user()->role_id==5){
                $mst=MSvendor::where('users_id',Auth::user()->id)->first();
            }else{
                $mst=MSvendor::where('id',$request->vendor_id)->first();
            }
            if($mst->status==6){
                $status=7;
            }else{
                $status=$mst->status;
            }
           
            $vendor=MSvendor::where('id',$mst->id)->update([
                'status_approve'=>2,
                'status'=>$status,
                'waktu_kirim'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
             
                
       
    }
    public function store_lanjut_terima(request $request){
        error_reporting(0);
        
            $vendor=MSvendor::where('id',$request->id)->update([
                'status_approve'=>3,
                'waktu_terima'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
             
                
       
    }
    public function store_undangan(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['perihal']= 'required';
        $messages['perihal.required']= 'Silahkan isi kolom perihal ';

        $rules['jadwal_verifikasi']= 'required';
        $messages['jadwal_verifikasi.required']= 'Silahkan isi kolom jadwal pelaksanaan ';

        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
        
            $vendor=MSvendor::where('id',$request->id)->update([
                'status_approve'=>4,
                'perihal'=>$request->perihal,
                'jadwal_verifikasi'=>$request->jadwal_verifikasi,
                'waktu_undangan'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
        }
             
                
       
    }
    public function store_verifikasi(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['status']= 'required';
        $messages['status.required']= 'Silahkan pilih status verifikasi ';

        if($request->status==2){
            $rules['alasan']= 'required';
            $messages['alasan.required']= 'Silahkan isi kolom alasan';
        }
        

        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            if($request->status==2){
                $status=10;
                $kode_vendor=null;
                
            }else{
                $status=5;
                $kode_vendor=kode_vendor();
            }
            $vendor=MSvendor::where('id',$request->id)->update([
                'status_approve'=>$status,
                'kode_vendor'=>$kode_vendor,
                'alasan_pengembalian'=>$request->alasan,
                'waktu_verifikasi'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
        }
             
                
       
    }
    public function store_verifikasi_create(request $request){
        error_reporting(0);
        
            $kode_vendor=kode_vendor();
            $vendor=MSvendor::where('id',$request->vendor_id)->where('status_approve',1)->update([
                'status'=>6,
                'status_approve'=>5,
                'kode_vendor'=>$kode_vendor,
                'waktu_verifikasi'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            echo'@ok';
            
                
       
    }

    public function store_bank(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        $rules['pemilik']= 'required';
        $messages['pemilik.required']= 'Silahkan isi kolom pemilik rekening';

        $rules['bank_id']= 'required|numeric';
        $messages['bank_id.required']= 'Silahkan pilih BANK ';
        $messages['bank_id.numeric']= 'Format salah ';

        $rules['kode_bank']= 'required';
        $messages['kode_bank.required']= 'Silahkan isi nama kode_bank ';

        $rules['alamat_bank']= 'required';
        $messages['alamat_bank.required']= 'Silahkan isi alamat BANK ';

        if($request->id==0){
            $rules['no_rekening']= 'required|numeric|unique:mst_rekening_vendor';
            $messages['no_rekening.required']= 'Silahkan isi nama nomor rekening ';
            $messages['no_rekening.numeric']= 'Format no_rekening harus angka ';
            $messages['no_rekening.unique']= 'nomor rekening sudah terdaftar ';
        }else{
            $rules['no_rekening']= 'required|numeric';
            $messages['no_rekening.required']= 'Silahkan isi nama nomor rekening ';
            $messages['no_rekening.numeric']= 'Format no_rekening harus angka ';
        }

        $rules['cabang']= 'required';
        $messages['cabang.required']= 'Silahkan isi kolom cabang ';
        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
           if($request->id>0){
                $data=MSvendorrekening::where('id',$request->id)->update([
                        'pemilik'=>$request->pemilik,
                        'bank_id'=>$request->bank_id,
                        'no_rekening'=>$request->no_rekening,
                        'kode_bank'=>$request->kode_bank,
                        'alamat_bank'=>$request->alamat_bank,
                        'cabang'=>$request->cabang,
                        'updated_at'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
            }else{
                $data=MSvendorrekening::create([
                        'pemilik'=>$request->pemilik,
                        'bank_id'=>$request->bank_id,
                        'no_rekening'=>$request->no_rekening,
                        'kode_bank'=>$request->kode_bank,
                        'alamat_bank'=>$request->alamat_bank,
                        'cabang'=>$request->cabang,
                        'vendor_id'=>$request->vendor_id,
                        'users_id'=>$request->users_id,
                        'created_at'=>date('Y-m-d H:i:s'),
                ]);
                $vendor=MSvendor::where('id',$request->vendor_id)->update([
                    'status_rekening'=>1,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }
        }
    }

    public function store_personil(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        $rules['nama']= 'required';
        $messages['nama.required']= 'Silahkan isi kolom nama personil';

        $rules['no_ktp']= 'required|numeric';
        $messages['no_ktp.required']= 'Silahkan isi kolom No KTP ';
        $messages['no_ktp.numeric']= 'Format ktp salah ';

        $rules['tempat_lahir']= 'required';
        $messages['tempat_lahir.required']= 'Silahkan isi kolom tempat lahir ';

        $rules['tgl_lahir']= 'required';
        $messages['tgl_lahir.required']= 'Silahkan isi kolom tanggal lahir ';

        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Silahkan isi kolom alamat ';

        $rules['jabatan_id']= 'required';
        $messages['jabatan_id.required']= 'Silahkan isi kolom jabatan';

        $rules['email']= 'required|email';
        $messages['email.required']= 'Silahkan isi kolom email ';
        $messages['email.email']= 'Format email salah';

        $rules['telepon']= 'required|numeric';
        $messages['telepon.required']= 'Silahkan isi kolom telepon ';
        $messages['telepon.numeric']= 'Format telepon salah';

        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
           if($request->id>0){
                $data=MSvendorpersonil::where('id',$request->id)->update([
                        'nama'=>$request->nama,
                        'nik'=>$request->no_ktp,
                        'tempat_lahir'=>$request->tempat_lahir,
                        'tgl_lahir'=>$request->tgl_lahir,
                        'alamat'=>$request->alamat,
                        'jabatan_id'=>$request->jabatan_id,
                        'email'=>$request->email,
                        'updated_at'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
            }else{
                $data=MSvendorpersonil::create([
                        'nama'=>$request->nama,
                        'nik'=>$request->no_ktp,
                        'tempat_lahir'=>$request->tempat_lahir,
                        'tgl_lahir'=>$request->tgl_lahir,
                        'alamat'=>$request->alamat,
                        'jabatan_id'=>$request->jabatan_id,
                        'email'=>$request->email,
                        'telepon'=>$request->telepon,
                        'vendor_id'=>$request->vendor_id,
                        'users_id'=>$request->users_id,
                        'created_at'=>date('Y-m-d H:i:s'),
                ]);
                
                echo'@ok';
            }
        }
    }

    public function store_dokumen(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        $rules['file']= 'required|mimes:'.$request->format;
        $messages['file.required']= 'Silahkan upload file';
        $messages['file.mimes']= 'Hanya menerima format ('.$request->format.')';

        $rules['berlaku']= 'required|date|after:today';
        $messages['berlaku.required']= 'Silahkan isi masa berlaku dokumen';
        $messages['berlaku.date']= 'Format tanggal salah';
        $messages['berlaku.after']= 'Upload dokumen yang masih berlaku';

        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            $mst=MSvendor::where('id',$request->vendor_id)->first();
            $image = $request->file('file');
            $nama=linknya($request->perusahaan).'-'.$request->kode_dokumen;
            $imageFileName =$nama.'.'.$image->getClientOriginalExtension();
            $filePath =$imageFileName;
            $file =\Storage::disk('public_dokumen');
            if($file->put($filePath, file_get_contents($image))){
                $data=MSvendordokumen::UpdateOrcreate([
                        'vendor_id'=>$request->vendor_id,
                        'berlaku'=>$request->berlaku,
                        'users_id'=>$request->users_id,
                        'dokumen_id'=>$request->id,
                        'pengadaan_id'=>$mst->pengadaan_id,
                ],[
                        'tipe'=>$image->getClientOriginalExtension(),
                        'file'=>$filePath, 
                        'created_at'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
            }
           
        }
    }
    

    public function store_komoditi(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        $rules['status_komoditi_id']= 'required';
        $messages['status_komoditi_id.required']= 'Silahkan pilih komoditi';

        $rules['file']= 'required|mimes:jpg,jpeg,pdf,png';
        $messages['file.required']= 'Silahkan upload file';
        $messages['file.mimes']= 'Hanya menerima format ('.$request->format.')';

        
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            $image = $request->file('file');
            $nama='KOM_'.$request->nama_file;
            $imageFileName =$nama.'.'.$image->getClientOriginalExtension();
            $filePath =$imageFileName;
            $file =\Storage::disk('public_dokumen');
            if($file->put($filePath, file_get_contents($image))){
                $data=MSvendorkomoditi::UpdateOrcreate([
                        'vendor_id'=>$request->vendor_id,
                        'users_id'=>$request->users_id,
                        'komoditi_id'=>$request->id,
                        'kode_komoditi'=>$request->kode_komoditi,
                ],[
                        'status_komoditi_id'=>$request->status_komoditi_id, 
                        'file_komoditi'=>$filePath, 
                        'created_at'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
            }
           
        }
    }
    
}

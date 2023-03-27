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
use App\Models\VMSkomoditi;
use App\Models\MSkomoditi;
use App\Models\MSvendorrekening;
use App\Models\MSvendorkomoditi;
use App\Models\MSvendorpersonil;
use App\Models\MSvendordokumen;
use App\Models\VMSvendorrekening;
use App\Models\VMSvendorpersonil;
class MasterController extends Controller
{
    
    public function index_komoditi(request $request)
    {
        error_reporting(0);
        $template='top';
        return view('komoditi.index',compact('template'));
    }
    public function view_komoditi(request $request)
    {
        error_reporting(0);
        
        $id=decoder($request->id);
        $ide=$request->id;
        $data=MSkomoditi::where('id',$id)->first();
        $template='top';
        return view('komoditi.view',compact('template','id','ide','data'));
        
        
    }
    
    public function delete_komoditi(request $request)
    {
        $id=decoder($request->id);
        $data=MSkomoditi::where('id',$id)->update(['active'=>0]);
    }
    public function get_data_komoditi(request $request)
    {
        error_reporting(0);
        $query = VMSkomoditi::query();
        $data = $query->where('active',1)->orderBy('id','Desc')->get();

        return Datatables::of($data)
            ->addColumn('seleksi', function ($row) {
                $btn='<span class="btn btn-success btn-xs" onclick="pilih_cost(`'.$row->cost_center.'`,`'.$row->customer_code.'`,`'.$row->customer.'`,`'.$row->deskripsi_project.'`)">Pilih</span>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                
                    $btn='<div class="btn-group">
                            <span class="btn btn-blue btn-xs" onclick="view_data(`'.encoder($row->id).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                            <span class="btn btn-danger btn-xs" onclick="delete_data(`'.encoder($row->id).'`)"><i class="fas fa-window-close fa-fw"></i></span>
                        </div>';
                return $btn;
            })
            
            
            ->rawColumns(['action','seleksi'])
            ->make(true);
    }

    

    public function store_komoditi(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        

        $rules['nama_komoditi']= 'required';
        $messages['nama_komoditi.required']= 'Silahkan isi kolom nama komoditi ';

        $rules['tipe_komoditi']= 'required|numeric';
        $messages['tipe_komoditi.required']= 'Silahkan isi nama tipe komoditi ';
        $messages['tipe_komoditi.numeric']= 'Format tipe komoditi salah ';

        $rules['deskripsi_komoditi']= 'required';
        $messages['deskripsi_komoditi.required']= 'Silahkan isi kolom deskripsi komoditi ';

        
        
        
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
            $id=decoder($request->id);
            if($id==0){
                $datas=MSkomoditi::create([
                    'kode_komoditi'=>penomoran_komoditi($request->tipe_komoditi),
                    'nama_komoditi'=>$request->nama_komoditi,
                    'tipe_komoditi'=>$request->tipe_komoditi,
                    'active'=>1,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'deskripsi_komoditi'=>$request->deskripsi_komoditi,
                ]);
                echo'@ok';
            }else{
                $datas=MSkomoditi::where('id',$id)->update([
                    'nama_komoditi'=>$request->nama_komoditi,
                    'tipe_komoditi'=>$request->tipe_komoditi,
                    'deskripsi_komoditi'=>$request->deskripsi_komoditi,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }
            
            
        }
    }

    
    
}

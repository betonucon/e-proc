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
class RegController extends Controller
{
    
    public function index(request $request)
    {
        error_reporting(0);
        $template='top';
        return view('index',compact('template'));
    }
    public function rekanan(request $request)
    {
        error_reporting(0);
        $template='top';
        return view('auth.register_rekanan',compact('template'));
    }

    public function store_rekanan(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        
        $rules['npwp']= 'required|numeric';
        $messages['npwp.required']= 'Silahkan isi kolom NPWP ';
        $messages['npwp.numeric']= 'Format NPWP harus angka ';

        $rules['perusahaan']= 'required';
        $messages['perusahaan.required']= 'Silahkan isi nama perusahaan ';

        $rules['badan_usaha_id']= 'required';
        $messages['badan_usaha_id.required']= 'Silahkan isi pilih badan usaha ';

        $rules['email']= 'required|email|unique:users';
        $messages['email.required']= 'Silahkan isi nama email ';
        $messages['email.email']= 'Format email salah ';
        $messages['email.unique']= 'Email sudah terdaftar ';

        $rules['password']= 'required|min:6|confirmed';
        $messages['password.required']= 'Silahkan isi  password ';
        $messages['password.min']= 'Password Minimal 6 karakter ';
        $messages['password.confirmed']= 'Confirmasi password salah ';
       
        
        
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
            $cek=MSvendor::where('npwp',$request->npwp)->count();
            if($cek>0){
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">NPWP sudah terdaftar</div></div>';
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
                        'email'=>$request->email,
                        'badan_usaha_id'=>$request->badan_usaha_id,
                        'users_id'=>$data->id,
                        'status'=>1,
                        'status_approve'=>1,
                        'created_at'=>date('Y-m-d H:i:s'),
                ]);
                echo'@ok';
            }
        }
    }
    
}

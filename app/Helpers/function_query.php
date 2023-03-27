<?php

function get_badan_usaha(){
   $data=App\Models\MSbadanusaha::orderBy('id','Asc')->get();
   return $data;
}

function get_negara(){
   $data=App\Models\MSnegara::orderBy('negara','Asc')->get();
   return $data;
}
function get_status_approve_admin(){
   $data=App\Models\MSstatusapprove::whereIn('id',array(2,3,4,10))->orderBy('id','Asc')->get();
   return $data;
}

function get_jabatan(){
   $data=App\Models\MSjabatan::orderBy('jabatan','Asc')->get();
   return $data;
}

function get_status_vendor(){
   $data=App\Models\MSstatusvendor::orderBy('id','Asc')->get();
   return $data;
}

function get_komoditi($tipe_komoditi){
   $data=App\Models\MSkomoditi::where('tipe_komoditi',$tipe_komoditi)->orderBy('nama_komoditi','Asc')->get();
   return $data;
}

function get_view_komoditi($vendor_id){
   $data=App\Models\VMSvendorkomoditi::where('vendor_id',$vendor_id)->orderBy('nama_komoditi','Asc')->get();
   return $data;
}
function count_status_approve($status_approve){
   $data=App\Models\VMSvendor::where('status_approve',$status_approve)->count();
   return $data;
}

function cek_komoditi($vendor_id){
   $data=App\Models\VMSvendorkomoditi::where('vendor_id',$vendor_id)->count();
   return $data;
}
function cek_personil($vendor_id){
   $data=App\Models\VMSvendorpersonil::where('vendor_id',$vendor_id)->count();
   return $data;
}

function cek_view_komoditi($vendor_id,$komoditi_id){
   $data=App\Models\VMSvendorkomoditi::where('vendor_id',$vendor_id)->where('komoditi_id',$komoditi_id)->count();
   return $data;
}

function get_status_perusahaan(){
   $data=App\Models\MSstatusperusahaan::orderBy('id','Asc')->get();
   return $data;
}
function get_pengadaan(){
   $data=App\Models\MSpengadaan::orderBy('id','Asc')->get();
   return $data;
}
function get_pengadaan_admin(){
   $data=App\Models\MSpengadaan::whereIn('id',array(1,2))->orderBy('id','Asc')->get();
   return $data;
}
function count_pengadaan($pengadaan_id){
   if($pengadaan_id==0){
      $data=App\Models\VMSvendor::where('status_approve',5)->count();
   }else{
      $data=App\Models\VMSvendor::where('status_approve',5)->where('pengadaan_id',$pengadaan_id)->count();
   }
   
   return $data;
}
function persen_pengadaan($pengadaan_id){
   $tot=App\Models\VMSvendor::where('status_approve',5)->count();
   $data=App\Models\VMSvendor::where('status_approve',5)->where('pengadaan_id',$pengadaan_id)->count();
   if($data==0){
      $nil=0;
   }else{
      $nil=round(($tot/$data)*100);
   }
   
   
   return $nil;
}

function get_dokumen($tipe){
   $data=App\Models\MSdokumen::where('tipe_dokumen',$tipe)->orderBy('id','Asc')->get();
   return $data;
}
function cek_dokumen($vendor_id,$tipe){
   $tot=App\Models\MSdokumen::where('tipe_dokumen',$tipe)->count();
   $cek=App\Models\MSvendordokumen::where('vendor_id',$vendor_id)->where('pengadaan_id',$tipe)->count();
   if($cek>=$tot){
      $data=1;
   }else{
      $data=0;
   }
   return $data;
}

function count_dokumen($dokumen_id,$vendor_id){
   $cek=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->count();
   if($cek>0){
      $data=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->first();
      return $data->file;
   }else{
      return "";
   }
   
}

function berlaku_dokumen($dokumen_id,$vendor_id){
   $cek=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->count();
   if($cek>0){
      $data=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->first();
      return $data->berlaku;
   }else{
      return "";
   }
   
}

function total_waktu_dokumen($dokumen_id,$vendor_id){
   $cek=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->count();
   if($cek>0){
      $data=App\Models\VMSvendordokumen::where('dokumen_id',$dokumen_id)->where('vendor_id',$vendor_id)->first();
      return $data->waktu;
   }else{
      return "";
   }
   
}

function get_bank(){
   $data=App\Models\MSbank::orderBy('bank','Asc')->get();
   return $data;
}


?>
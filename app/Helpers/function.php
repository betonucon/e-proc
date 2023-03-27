<?php

function name(){
   return "PT.UCON BETON";
}
function alamat(){
   return "Link Jombang Kali, Kel Masigit Kec Jombang";
}
function email(){
   return "uconbeton@gmail.com";
}
function encoder($b) {
   $data=base64_encode(base64_encode($b));
   return $data;
}
function decoder($b) {
   $data=base64_decode(base64_decode($b));
   return $data;
}
function phone(){
   return "082312053337";
}
function pimpinan(){
   return "SOLAWAT S.E";
}
function linknya($name){
   $patr='/\s+/';
   $data=preg_replace($patr,'_',$name);
   return $data;
}
function tanggal_indo_lengkap($date){
   return date('d-m-Y H:i:s',strtotime($date));
}
function tanggal_indo($date){
   return date('d M,Y',strtotime($date));
}
function jam($date=null){
   if($date==""){
      return null;
   }else{
      return date('H:i:s',strtotime($date));
   }
   
}
function sekarang(){
   return date('Y-m-d H:i:s');
}
function selisih_waktu($waktu1,$waktu2){
   $waktu_awal        =strtotime($waktu1);
   $waktu_akhir    =strtotime($waktu2); // bisa juga waktu sekarang now()
   $diff    =$waktu_akhir - $waktu_awal;
   $jam    =floor($diff / (60 * 60));
   $menit    =$diff - $jam * (60 * 60);
   $data= $jam.'.'. floor( $menit / 60 );
   return $data;
}
function bulan_int($bulan)
{
   Switch ($bulan){
      case 1 : $bulan="Januari";
         Break;
      case 2 : $bulan="Februari";
         Break;
      case 3 : $bulan="Maret";
         Break;
      case 4 : $bulan="April";
         Break;
      case 5 : $bulan="Mei";
         Break;
      case 6 : $bulan="Juni";
         Break;
      case 7 : $bulan="Juli";
         Break;
      case 8 : $bulan="Agustus";
         Break;
      case 9 : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function ubah_uang($uang){
   $patr='/([^0-9]+)/';
   $ug=explode('.',$uang);
   $data=preg_replace($patr,'',$ug[0]);
   return $data;
}
function ubah_bulan($bulan){
   if($bulan>9){
      return '0'.$bulan;
   }else{
      return $bulan;
   }
   
}
function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}
function uang($nil){
   return number_format($nil,0);
}
function no_sepasi($text){
   return str_replace(' ', '_', $text);
}
function link_dokumen($file){
   $curl = curl_init();
     curl_setopt ($curl, CURLOPT_URL, "".url_plug()."/".$file);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

     $result = curl_exec ($curl);
     curl_close ($curl);
   print $result;
}
function url_plug(){
    $data=url('/public/');
    return $data;
}
function barcoderider($id,$w,$h){
    $d = new Milon\Barcode\DNS2D();
    $d->setStorPath(__DIR__.'/cache/');
    return $d->getBarcodeHTML($id, 'QRCODE',$w,$h);
}
function barcoderr($id){
    $d = new Milon\Barcode\DNS2D();
    $d->setStorPath(__DIR__.'/cache/');
    return $d->getBarcodePNGPath($id, 'PDF417');
}
function parsing_validator($url){
    $content=utf8_encode($url);
    $data = json_decode($content,true);
 
    return $data;
}

function tanggal_indo_full($tgl){
    $data=date('d/m/Y H:i:s',strtotime($tgl));
    return $data;
}

function penomoran_komoditi($tipe_komoditi){
    
    $cek=App\Models\MSkomoditi::where('tipe_komoditi',$tipe_komoditi)->count();
    if($tipe_komoditi==1){
      $kode='BKBS';
    }else{
      $kode='JKBS';
    }
    if($cek>0){
        $mst=App\Models\MSkomoditi::where('tipe_komoditi',$tipe_komoditi)->orderBy('kode_komoditi','Desc')->firstOrfail();
        $urutan = (int) substr($mst['kode_komoditi'], 4, 2);
        $urutan++;
        $nomor=$kode.sprintf("%02s",  $urutan);
    }else{
        $nomor=$kode.sprintf("%02s",  1);
    }
    return $nomor;
}

function kode_vendor(){
    
    $cek=App\Models\VMSvendor::where('status_approve',5)->count();
    if($cek>0){
        $mst=App\Models\VMSvendor::where('status_approve',5)->orderBy('kode_vendor','Desc')->firstOrfail();
        $urutan = (int) substr($mst['kode_vendor'], 0, 5);
        $urutan++;
        $nomor=sprintf("%05s",  $urutan);
    }else{
        $nomor=sprintf("%05s",  1);
    }
    return $nomor;
}

?>
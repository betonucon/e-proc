    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="vendor_id" value="{{$mst->id}}">
    <input type="hidden" name="users_id" value="{{$mst->users_id}}">
    <input type="hidden" name="nama_file" value="{{linknya($mst->perusahaan)}}_{{$data->kode_komoditi}}">
    <input type="hidden" name="kode_komoditi" value="{{$data->kode_komoditi}}">
    <input type="hidden" name="perusahaan" value="{{$mst->perusahaan}}">
    <div class="panel-body">			
        <div class="note note-yellow m-b-15">
            <div class="note-content">
                <h4 class="m-t-5 m-b-5 p-b-2">Komoditi {{$data->nama_komoditi}}</h4>
                <ul class="m-b-5 p-l-25">
                    <li>The maximum file size for uploads in this demo is <strong>300KB</strong> (default file size is unlimited).</li>
                    <li>Only files (<strong>PDF, PNG, JPG, JPEG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                 </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Komoditi</label>
                    <div class="col-lg-8">
                        <select name="status_komoditi_id" value="" class="form-control form-control-sm" placeholder="ketik disini...">
                            <option value="">Pilih  --</option>    
                            @foreach(get_status_vendor() as $bd)
                                <option value="{{$bd->id}}" @if($data->status_vendor_id==$bd->id) selected @endif >{{$bd->status_vendor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Lampiran</label>
                    <div class="col-lg-8">
                        <input type="file" name="file" value=""  class="form-control form-control-sm" placeholder="ketik disini...">
                    </div>
                </div>
                
            </div>
           
        </div>
    </div>
    <script>
        
        $('.default-select2').select2();
        $("#maskeddatetime1").mask("99:99:99");
        $("#maskeddatetime2").mask("99:99:99");
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>
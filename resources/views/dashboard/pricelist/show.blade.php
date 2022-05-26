@extends('dashboard.layouts.main')

@section('container')
<div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">View Data Pricelist</h6>
              <p>Please Entri Data Pricelist for Your transaction.</p> 
        </div>
        <div class="card-tools">
            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
        </div>
      </div>
        <form action="dashboard/pricelist/insert" method="post" id="form-price-list">
           <meta name="csrf-token" content="{{ csrf_token() }}">
              @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if(session()->has('failed'))
            <div class="alert alert-warning" role="alert">
                {{ session('failed') }}
            </div>
            @endif
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="form-group">
                         <label for="id" class="form-label"> ID <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm id" id="id" name="id" placeholder="Ketik Provinsi Tujuan Awal" autocomplete="off" value="{{ $merchant->id }}" readonly>
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                         <label for="name_provinces_start" class="form-label"> Provinsi Tujuan Awal <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm name_provinces_start" id="name_provinces_start" name="name_provinces_start" placeholder="Ketik Provinsi Tujuan Awal" autocomplete="off" value="{{ $merchant->name_provinces_start }}" >
                                <input type="hidden"  class="form-control form-control-sm" id="id_provinces_start" name="id_provinces_start" placeholder="Ketik Provinsi" value="{{ $merchant->id_provinces_start }}">
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_regencies_start" class="form-label">Kab/Kota Tujuan Awal <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input autocomplete="off" type="text" class="form-control form-control-sm name_regencies_start"  id="name_regencies_start" name="name_regencies_start" placeholder="Ketik Kabupaten Tujuan Awal" value="{{ $merchant->name_regencies_start }}">
                                <input type="hidden" class="form-control form-control-sm " id="id_regencies_start" name="id_regencies_start" placeholder="Kabupaten Akhir" value="{{ $merchant->id_regencies_start }}">
                            </div>
                    </div>
                </div>      
                <div class="col-lg-6">
                    <div class="form-group">
                       <label for="name_provinces_end" class="form-label">Provinsi Tujuan Akhir <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input autocomplete="off" type="text" class="form-control form-control-sm name_provinces_end" id="name_provinces_end" name="name_provinces_end" placeholder="Ketik Provinsi Tujuan Akhir"  value="{{ $merchant->name_provinces_end }}">
                                <input type="hidden"  class="form-control form-control-sm" id="id_provinces_end" name="id_provinces_end" placeholder="Ketik Provinsi"  value="{{ $merchant->id_provinces_end }}">
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_regencies_end" class="form-label">Kab/Kota Tujuan Akhir <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input autocomplete="off" type="text" class="form-control form-control-sm name_regencies_end"  id="name_regencies_end" name="name_regencies_end" placeholder="Ketik Kabupaten Tujuan Akhir"  value="{{ $merchant->name_regencies_end }}">
                                <input type="hidden" class="form-control form-control-sm id_regencies_end" id="id_regencies_end" name="id_regencies_end" placeholder="Kabupaten Akhir"  value="{{ $merchant->id_regencies_end }}">
                            </div>
                    </div>
                </div>  
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_packet" class="form-label">Pilih Paket <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-select col-sm-9" name="id_packet" id="id_packet" >
                                </select>
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                         <label for="price" class="form-label">Nilai Tarif <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm price" id="price" name="price" placeholder="Ketik Nilai tarif"  value="{{ $merchant->price }}">  
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="price_asuransi" class="form-label">Asuransi <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <input type="text" autocomplete="off" class="form-control form-control-sm" id="price_asuransi" name="price_asuransi" placeholder="Ketik Nilai Asuransi" value="{{ $merchant->price_asuransi }}"> 
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_provinces_end" class="form-label">Pilih Jenis Pengiriman <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-select" name="id_jenis_pengiriman" id="id_jenis_pengiriman">  
                                </select>
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_provinces_end" class="form-label">Status <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-select" name="status" id="status"> 
                                        <option value="Active" selected>Active</option>   
                                        <option value="Stop" >Stop</option>   
                                </select>
                            </div>
                    </div>
                </div> 
            </div>
             <div class="btn-group">
                <button type="submit" class="btn btn-primary mt-3"><i class="icon bi bi-file-earmark-plus"></i><span>Save</span></button>
                <button type="button" onclick="backurl()" class="btn btn-light mt-3"><i class="icon bi bi-arrow-down-right-square"></i><span>Back</span></button>
             </div>
        </form> 
    </div>                                   
  </div>
</div><!-- .col -->     
<script>
    var base_url = window.location.origin;
    loadall();
    convertNumberToRp(); 

    
    $( "#form-price-list" ).submit(function( e ) {
        e.preventDefault(); 
         swal({
            title: "Simpan",
            text: "Pastikan data sudah terisi semua, lanjut simpan ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var form_data = new FormData();  
                        form_data.append("id", $("#id").val());
                        form_data.append("name_provinces_start", $("#name_provinces_start").val());
                        form_data.append("id_provinces_start", $("#id_provinces_start").val());
                        form_data.append("name_regencies_start", $("#name_regencies_start").val());
                        form_data.append("id_regencies_start", $("#id_regencies_start").val());
                        form_data.append("name_provinces_end", $("#name_provinces_end").val());
                        form_data.append("id_provinces_end", $("#id_provinces_end").val());
                        form_data.append("name_regencies_end", $("#name_regencies_end").val());
                        form_data.append("id_regencies_end", $("#id_regencies_end").val());
                        form_data.append("price", price_to_number($("#price").val()));
                        form_data.append("price_asuransi", price_to_number($("#price_asuransi").val()));
                        form_data.append("id_jenis_pengiriman", $("#id_jenis_pengiriman").val());
                        form_data.append("id_packet", $("#id_packet").val());
                        form_data.append("status", $("#status").val());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "/dashboard/pricelist/update",
                        data: form_data, //pass to our Ajax data to send 
                        success: function (response) {
                            swalSuccess(response.message); 
                        },
                        error: function(response) { 
                            swalError(response.responseJSON.message);
                        },
                        contentType: false,
                        processData: false,
                    });
                } else {
                   // swal("Transaction Rollback !");
                }
            });
    });

    var prov_start = "{{ route('autocompleteprovinces') }}"; 
    $('input.name_provinces_start').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            return $.get(prov_start, { query: query }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_provinces_start').val(data.id);
        }
    });
    var regencies_start = "{{ route('autocompleteRegencies') }}"; 
    $('input.name_regencies_start').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_provisnc =  document.getElementById("id_provinces_start").value;
            return $.get(regencies_start, { query: query, id_provinces : id_provisnc }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_regencies_start').val(data.id);
        }
    });
    var prov_end = "{{ route('autocompleteprovinces') }}"; 
    $('input.name_provinces_end').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            return $.get(prov_end, { query: query }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_provinces_end').val(data.id);
        }
    });
    var regencies_end = "{{ route('autocompleteRegencies') }}"; 
    $('input.name_regencies_end').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_provisnc =  document.getElementById("id_provinces_end").value;
            return $.get(regencies_start, { query: query, id_provinces : id_provisnc }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_regencies_end').val(data.id);
        }
    });

    async function loadall() {
        try{
            const dtgetPaket = await getPaket(); 
            updateUIdtgetPaket(dtgetPaket);
            const dtshippingtype = await getShippingType();
            updateUIdtshippingtype(dtshippingtype);
            const dtgetHargaPengirimanByIDJson = await getHargaPengirimanByIDJson();
            updateUIdtgetHargaPengirimanByIDJson(dtgetHargaPengirimanByIDJson); 
            console.log(dtgetJenisPengirimanByIDJson);
        } catch (err) {
           // toast(err, "error")
           console.log(err);
        }
    }
    function updateUIdtgetHargaPengirimanByIDJson(params) {
         $('#id_packet').val(params.data[0].id_packet).trigger('change'); 
         $('#id_jenis_pengiriman').val(params.data[0].id_jenis_pengiriman).trigger('change'); 
    }
    function updateUIdtshippingtype(dtshippingtype) { 
        let responseApi = dtshippingtype.data[0];
        if (responseApi !== null && responseApi !== undefined) { 
            var newRow = '<option value="">-- PILIH --</option';
            $("#id_jenis_pengiriman").append(newRow);
            for (i = 0; i < responseApi.length; i++) { 
                var newRow = '<option value="' + responseApi[i].shipping_type_id + '">' + responseApi[i].shipping_type_name + '</option';
                $("#id_jenis_pengiriman").append(newRow);
            }
        }
    }
    function updateUIdtgetPaket(updateUIdtgetPaket) { 
        let responseApi = updateUIdtgetPaket.data[0];
        if (responseApi !== null && responseApi !== undefined) { 
            var newRow = '<option value="">-- PILIH --</option';
            $("#id_packet").append(newRow);
            for (i = 0; i < responseApi.length; i++) { 
                var newRow = '<option value="' + responseApi[i].id + '">' + responseApi[i].packet_name + '</option';
                $("#id_packet").append(newRow);
            }
        }
    }
    
    function getHargaPengirimanByIDJson() {
        let url = base_url + '/getDataPengirimanByIDJson';
         var form_data = new FormData();  
            form_data.append("id", $("#id").val());
            var id = $("#id").val();
        return fetch(url, {
            method: 'POST',
            headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
            body : "id=" + id
        })
            .then(response => {
                if (!response.ok) { throw new Error(response.statusText) }  return response.json();
            })
            .then(response => {
                if (response.status === "error") { throw new Error(response.message.errorInfo[2]);  } 
                else if (response.status === "warning") {  throw new Error(response.errorname);  }
                return response
            })
            .finally(() => {
                // $("#caramasuk").select2(); 
            })
    }
    function getPaket() {
        let url = base_url + '/getDataPacketJSon';
        return fetch(url, {
            method: 'GET',
            headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" }
        })
            .then(response => {
                if (!response.ok) { throw new Error(response.statusText) }  return response.json();
            })
            .then(response => {
                if (response.status === "error") { throw new Error(response.message.errorInfo[2]);  } 
                else if (response.status === "warning") {  throw new Error(response.errorname);  }
                return response
            })
            .finally(() => {
                // $("#caramasuk").select2(); 
            })
    }
    function getShippingType() {
        var base_url = window.location.origin;
        let url = base_url + '/getDataShipingTypeJSon';
        return fetch(url, {
            method: 'GET',
            headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" }
        })
            .then(response => {
                if (!response.ok) { throw new Error(response.statusText) }  return response.json();
            })
            .then(response => {
                if (response.status === "error") { throw new Error(response.message.errorInfo[2]);  } 
                else if (response.status === "warning") {  throw new Error(response.errorname);  }
                return response
            })
            .finally(() => {
                // $("#caramasuk").select2(); 
            })
    }
    // penting
    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "" + rupiah : ",00";
}
function number_to_price(v) {
    if (v == 0) { return '0,00'; }
    v = parseFloat(v);
    v = v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v = v.split('.').join('*').split(',').join('.').split('*').join(',');
    return v;
}
function price_to_number(v) {
    if (!v) { return 0; }
    v = v.split('.').join('');
    v = v.split(',').join('.');
    return Number(v.replace(/[^0-9.]/g, ""));
}
function convertNumberToRp() {
    var v_price = document.getElementById("price");
    v_price.addEventListener("keyup", function (e) {
        v_price.value = formatRupiah(this.value);
    }); 
    var v_price_asuransi = document.getElementById("price_asuransi");
    v_price_asuransi.addEventListener("keyup", function (e) {
        v_price_asuransi.value = formatRupiah(this.value);
    }); 
}

function swalError(data) {
        swal({
            title: "Error",
            text: data,
            icon: "error",  
        });
}
function swalSuccess(data) {
        swal({
            title: "Success",
            text: data,
            icon: "success",  
        }).then((willDelete) => {
                if (willDelete) {
                    location.reload();
                }  
            });
}
  function backurl() {
        window.location.href = '/dashboard/pricelist';
    }
</script>
@endsection
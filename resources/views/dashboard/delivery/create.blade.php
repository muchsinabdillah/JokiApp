@extends('dashboard.layouts.main')

@section('container')

<div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">Sender Data</h6>
              <p>Please Entri Data Sender Here.</p> 
        </div>
        <div class="card-tools">
            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
        </div>
      </div> 
            <div class="row g-4">
                <figure  style="margin-bottom: -10px">
                <blockquote class="blockquote">
                    <p>Input Data Pengirim</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Silahkan Masukan Data Pengirim
                </figcaption>
                </figure> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <form action="dashboard/delivery/insert" autocomplete="off" method="post" id="form-delivery-transaction">
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
                         <label for="name_provinces_sender" class="form-label">Provinsi Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_provinces_sender" id="name_provinces_sender" name="name_provinces_sender"  placeholder="Ketik Provinsi Pengirim" value="{{  old('name_provinces_sender') }}" >
                                @error('name_provinces_sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden"  class="form-control form-control-sm" value="{{  old('id_provinces_sender') }}" id="id_provinces_sender" name="id_provinces_sender" placeholder="Ketik Provinsi">
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_regencies_sender" class="form-label">Kab/Kota Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text"  autocomplete="off" class="form-control form-control-sm name_regencies_sender"  id="name_regencies_sender" name="name_regencies_sender"  value="{{  old('name_regencies_sender') }}" placeholder="Ketik Kabupaten Pengirim">
                                @error('name_regencies_sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm name_regencies_sender" value="{{  old('id_regencies_sender') }}" id="id_regencies_sender" name="id_regencies_sender" placeholder="Kabupaten Akhir">
                            </div>
                    </div>
                </div>      
                <div class="col-lg-6">
                    <div class="form-group">
                       <label for="name_distrits_sender" class="form-label">Kecamatan Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_distrits_sender" id="name_distrits_sender"  value="{{  old('name_distrits_sender') }}"  name="name_distrits_sender" placeholder="Ketik Kecamatan Pengirim">
                                @error('name_distrits_sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm"  value="{{  old('id_distrits_sender') }}"  id="id_distrits_sender" name="id_distrits_sender" placeholder="Ketik Kecamatan">
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_villages_sender" class="form-label">Kelurahan Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_villages_sender" id="name_villages_sender" name="name_villages_sender"  value="{{  old('name_villages_sender') }}"  placeholder="Ketik Keluarahan Pengirim">
                                @error('name_villages_sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm id_villages_sender"   value="{{  old('id_villages_sender') }}"  id="id_villages_sender" name="id_villages_sender" placeholder="Keluarahan Awal">
                            </div>
                    </div>
                </div>     

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="address_sender" class="form-label">Alamat Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label> 
                            <div class="form-control-wrap">
                                <textarea class="form-control" placeholder="Ketik Alamat Pengirim" id="address_sender" name="address_sender" id="address_sender" style="height: 100px">{{  old('address_sender') }}</textarea>
                                @error('address_sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sender" class="form-label">Nama Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm" id="sender"  autocomplete="off"  value="{{  old('sender') }}"  name="sender" placeholder="Ketik Nama Pengirim">
                                @error('sender') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="senderphonenumber" class="form-label">No. Hp Pengirim <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm" autocomplete="off"   value="{{  old('senderphonenumber') }}"  id="senderphonenumber" name="senderphonenumber" placeholder="Ketik No. Handphone Pengirim">
                                @error('senderphonenumber')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div> 
                 <hr>
                <figure  style="margin-bottom: -10px">
                <blockquote class="blockquote">
                    <p>Input Data Pengirim</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Silahkan Masukan Data Pengirim
                </figcaption>
                </figure>  
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_provinces_receiver" class="form-label">Provinsi Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_provinces_receiver" id="name_provinces_receiver" name="name_provinces_receiver" placeholder="Ketik Provinsi Penerima" value="{{  old('name_provinces_receiver') }}" >
                                @error('name_provinces_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm" id="id_provinces_receiver" name="id_provinces_receiver"  value="{{  old('id_provinces_receiver') }}" >
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_regencies_receiver" class="form-label">Kab/Kota Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_regencies_receiver" id="name_regencies_receiver" name="name_regencies_receiver" placeholder="Ketik Kabupaten Penerima"  value="{{  old('name_regencies_receiver') }}" >
                                @error('name_regencies_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm" id="id_regencies_receiver" name="id_regencies_receiver"  value="{{  old('id_regencies_receiver') }}" >
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_distrits_receiver" class="form-label">Kecamatan Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_distrits_receiver" id="name_distrits_receiver" name="name_distrits_receiver" placeholder="ketik Kecamatan Penerima"  value="{{  old('name_distrits_receiver') }}" >
                                @error('name_distrits_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm" id="id_distrits_receiver" name="id_distrits_receiver"  value="{{  old('id_distrits_receiver') }}"  >
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_villages_receiver" class="form-label">Kelurahan Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-sm name_villages_receiver" id="name_villages_receiver" name="name_villages_receiver" placeholder="Ketik kelurahan Penerima"  value="{{  old('name_villages_receiver') }}" >
                                @error('name_villages_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                                <input type="hidden" class="form-control form-control-sm" id="id_villages_receiver" name="id_villages_receiver" placeholder="Ketik kelurahan Penerima"  value="{{  old('id_villages_receiver') }}" >
                            </div>
                    </div>
                </div> 
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="address_receiver" class="form-label">Alamat Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" placeholder="Ketik Alamat Penerima" id="address_receiver" name="address_receiver" style="height: 100px">{{  old('address_receiver') }}</textarea>
                                @error('address_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sender_receiver" class="form-label">Nama Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm" id="sender_receiver" placeholder="Ketik Nama Penerima"  value="{{  old('sender_receiver') }}" >
                                @error('sender_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="senderphonenumber_receiver" class="form-label">No. Hp Penerima <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <input type="text" class="form-control form-control-sm" id="senderphonenumber_receiver" placeholder="Ketik No. Hp Penerima" value="{{  old('senderphonenumber_receiver') }}" >
                                @error('senderphonenumber_receiver')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                <hr>
                 <figure  style="margin-bottom: -10px">
                <blockquote class="blockquote">
                    <p>Input Data Transaksi</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Silahkan Masukan Data Transaksi
                </figcaption>
                </figure> 
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="id_transaction_delivery" class="form-label">No. Resi <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <input type="email" class="form-control form-control-sm" id="id_transaction_delivery" name="id_transaction_delivery" readonly>
                            </div>
                    </div>
                </div>  
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_packet" class="form-label">Jenis Paket <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <select class="form-select col-sm-9" name="id_packet" id="id_packet" onchange="DataShipping();" >
                                </select>
                            </div>
                    </div>
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_shippingype" class="form-label">Jenis Pengiriman <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <select class="form-select col-sm-9" name="id_shippingtype" id="id_shippingtype" onchange="DataPrice();" >
                                </select>
                            </div>
                    </div>
                </div>  
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="weight" class="form-label">Berat (Kg)<span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm" id="weight" autocomplete="off"  name="weight" placeholder="Masukan Berat Barang" value="{{  old('weight') }}" onkeyup="calculatePrice()">
                                @error('weight')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="size" class="form-label">Ukuran (Kg)<span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <input type="text" class="form-control form-control-sm" autocomplete="off"   id="size" name="size" placeholder="Masukan Ukurang Barang" value="{{  old('size') }}">
                                @error('size')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="price_asuransi" class="form-label">Asuransi (Kg) <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                               <input type="text" class="form-control form-control-sm" autocomplete="off" readonly  id="price_asuransi" name="price_asuransi" value="{{  old('price_asuransi') }}" >
                                @error('price_asuransi')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="price" class="form-label">Harga (Kg) <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-sm" autocomplete="off" readonly  id="price" name="price" value="{{  old('price') }}">
                                @error('price')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  

                 <div class="col-lg-3">
                    <div class="form-group">
                        <label for="price_total" class="form-label">Total Harga <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" readonly class="form-control form-control-sm" autocomplete="off" id="price_total" name="price_total" value="{{  old('price_total') }}">
                                @error('price_total')  
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                 <div class="col-lg-3">
                    <div class="form-group">
                        <label for="transaction_status" class="form-label">Status Pengiriman <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" readonly class="form-control form-control-sm" id="transaction_status"  >
                            </div>
                    </div>
                </div>  
                 <div class="col-lg-3">
                    <div class="form-group">
                        <label for="date_update" class="form-label">Date Update <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" readonly class="form-control form-control-sm" id="date_update" name="date_update" >
                            </div>
                    </div>
                </div>  
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Description" class="form-label">Deskripsi Barang <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label> 
                            <div class="form-control-wrap">
                                <textarea class="form-control" required placeholder="Ketik Deskripsi Barang" id="Description" name="Description" id="Description" style="height: 100px">{{  old('Description') }}</textarea>
                                @error('Description') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>  
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Instruction" class="form-label">Instruksi Khusus <span aria-hidden="true" role="presentation" class="field_required" style="color:#ee0000;">*</span></label> 
                            <div class="form-control-wrap">
                                <textarea class="form-control" required placeholder="Ketik Instruksi Khusus" id="Instruction" name="Instruction" id="Instruction" style="height: 100px">{{  old('Instruction') }}</textarea>
                                @error('Instruction') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>    
            </div>
             <div class="btn-group">
                <button type="submit" class="btn btn-primary mt-3"><i class="icon bi bi-file-earmark-plus"></i><span>Save</span></button>
                <button type="button" onclick="backurl()" class="btn btn-light mt-3"><i class="icon bi bi-arrow-down-right-square"></i><span>Back</span></button>
             </div>
        
    </div>                                   
  </div>
</div><!-- .col --> 


</form> 
<script >  
var base_url = window.location.origin; 

loadall();
convertNumberToRp(); 
    async function loadall() {
        try{
            const dtgetPaket = await getPaket(); 
            updateUIdtgetPaket(dtgetPaket); 
        } catch (err) {
           // toast(err, "error")
           console.log(err);
        }
    }
    async function DataPrice() {
        try{
            const dtgetDataPrice = await getDataPrice(); 
            console.log(dtgetDataPrice);
            updateUIddtgetDataPrice(dtgetDataPrice); 
        } catch (err) {
           // toast(err, "error")
           console.log(err);
        }
    }
    function updateUIddtgetDataPrice(params) { 
        $('#price').val(number_to_price(params.data[0][0].price));
        $('#price_asuransi').val(number_to_price(params.data[0][0].price_asuransi));
    }
    function updateUIdtgetDataShipping(dtgetDataShipping) { 
        let responseApi = dtgetDataShipping.data[0];
         $("#id_shippingtype").empty();
        if (responseApi !== null && responseApi !== undefined) { 
            var newRow = '<option value="">-- PILIH --</option';
            $("#id_shippingtype").append(newRow);
            for (i = 0; i < responseApi.length; i++) { 
                var newRow = '<option value="' + responseApi[i].id_jenis_pengiriman + '">' + responseApi[i].shipping_type_name + '</option';
                $("#id_shippingtype").append(newRow);
            }
        }
    }
    function getDataPrice() {
        let url = base_url + '/getDataPriceJSon';
        var name_provinces_sender =  $('#name_provinces_sender').val();
        var id_provinces_sender =  $('#id_provinces_sender').val(); 
        var id_regencies_sender =  $('#id_regencies_sender').val(); 
        var id_distrits_sender =  $('#id_distrits_sender').val(); 
        var id_villages_sender =  $('#id_villages_sender').val(); 

        var id_provinces_receiver =  $('#id_provinces_receiver').val(); 
        var id_regencies_receiver =  $('#id_regencies_receiver').val(); 
        var id_distrits_receiver =  $('#id_distrits_receiver').val(); 
        var id_villages_receiver =  $('#id_villages_receiver').val(); 
        
        var id_packet =  $('#id_packet').val(); 
        var id_shippingtype =  $('#id_shippingtype').val(); 

        return fetch(url, {
            method: 'POST',
            headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
            body : "id_provinces_sender=" + id_provinces_sender + "&id_regencies_sender=" + id_regencies_sender
                     + "&id_provinces_receiver=" + id_provinces_receiver + "&id_regencies_receiver=" + id_regencies_receiver
                      + "&id_packet=" + id_packet  + "&id_shippingtype=" + id_shippingtype  
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
    async function DataShipping() {
        try{
            const dtgetDataShipping= await getDataShipping();  
            updateUIdtgetDataShipping(dtgetDataShipping); 
        } catch (err) {
           // toast(err, "error")
           console.log(err);
        }
    }
    function updateUIdtgetDataShipping(dtgetDataShipping) { 
        $("#id_shippingtype").empty();
        let responseApi = dtgetDataShipping.data[0];
        if (responseApi !== null && responseApi !== undefined) { 
            var newRow = '<option value="">-- PILIH --</option';
            
            $("#id_shippingtype").append(newRow);
            for (i = 0; i < responseApi.length; i++) { 
                var newRow = '<option value="' + responseApi[i].id_jenis_pengiriman + '">' + responseApi[i].shipping_type_name + '</option';
                $("#id_shippingtype").append(newRow);
            }
        }
    }
    function getDataShipping() {
        let url = base_url + '/getDataShippingJSon';
        var name_provinces_sender =  $('#name_provinces_sender').val();
        var id_provinces_sender =  $('#id_provinces_sender').val(); 
        var id_regencies_sender =  $('#id_regencies_sender').val(); 
        var id_distrits_sender =  $('#id_distrits_sender').val(); 
        var id_villages_sender =  $('#id_villages_sender').val(); 

        var id_provinces_receiver =  $('#id_provinces_receiver').val(); 
        var id_regencies_receiver =  $('#id_regencies_receiver').val(); 
        var id_distrits_receiver =  $('#id_distrits_receiver').val(); 
        var id_villages_receiver =  $('#id_villages_receiver').val(); 
        var id_packet =  $('#id_packet').val();  
        if(id_provinces_sender == ""){
            swalError("Silahkan Masukan Data Provinsi Pengirim dengan benar !")
        }else if(id_regencies_sender == ""){
            swalError("Silahkan Masukan Data Kabupaten Pengirim dengan benar !")
        }else if(id_provinces_receiver == ""){
            swalError("Silahkan Masukan Data Provinsi Penerima dengan benar !")
        }else if(id_regencies_receiver == ""){
            swalError("Silahkan Masukan Data Kabupaten Penerima  dengan benar !")
        }else{
            return fetch(url, {
            method: 'POST',
            headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
            body : "id_provinces_sender=" + id_provinces_sender + "&id_regencies_sender=" + id_regencies_sender
                     + "&id_provinces_receiver=" + id_provinces_receiver + "&id_regencies_receiver=" + id_regencies_receiver
                      + "&id_packet=" + id_packet  
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
        
    }
    function updateUIdtgetPaket(updateUIdtgetPaket) { 
        let responseApi = updateUIdtgetPaket.data[0];
         $("#id_packet").empty();
        if (responseApi !== null && responseApi !== undefined) { 
            var newRow = '<option value="">-- PILIH --</option';
            $("#id_packet").append(newRow);
            for (i = 0; i < responseApi.length; i++) { 
                var newRow = '<option value="' + responseApi[i].id + '">' + responseApi[i].packet_name + '</option';
                $("#id_packet").append(newRow);
            }
        }
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
    var prov_sender = "{{ route('autocompleteprovinces') }}"; 
    $('input.name_provinces_sender').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            return $.get(prov_sender, { query: query }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_provinces_sender').val(data.id);
        }
    });

    var prov_receiver = "{{ route('autocompleteprovinces') }}"; 
    $('input.name_provinces_receiver').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            return $.get(prov_receiver, { query: query }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_provinces_receiver').val(data.id);
        }
    });

    var regencies_sender = "{{ route('autocompleteRegencies') }}"; 
    $('input.name_regencies_sender').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_provisnc =  document.getElementById("id_provinces_sender").value;
            return $.get(regencies_sender, { query: query, id_provinces : id_provisnc }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_regencies_sender').val(data.id);
        }
    });

    var regencies_receiver = "{{ route('autocompleteRegencies') }}"; 
    $('input.name_regencies_receiver').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_provisnc =  document.getElementById("id_provinces_receiver").value;
            return $.get(regencies_sender, { query: query, id_provinces : id_provisnc }, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_regencies_receiver').val(data.id);
        }
    });
    
    var distrits_sender = "{{ route('autocompletedistrits') }}"; 
    $('input.name_distrits_sender').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_regencies=  $("#id_regencies_sender").val(); 
            return $.get(distrits_sender, { query: query, id_regencies: id_regencies}, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_distrits_sender').val(data.id);
        }
    });

    var distrits_receiver= "{{ route('autocompletedistrits') }}"; 
    $('input.name_distrits_receiver').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_regencies=  $("#id_regencies_receiver").val(); 
            return $.get(distrits_receiver, { query: query, id_regencies: id_regencies}, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_distrits_receiver').val(data.id);
        }
    });

    var villages_sender = "{{ route('autocompletevillages') }}"; 
    $('input.name_villages_sender').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_distrits=  $("#id_distrits_sender").val(); 
            return $.get(villages_sender, { query: query, id_distrits: id_distrits}, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_villages_sender').val(data.id);
        }
    });
    
    var villages_receiver = "{{ route('autocompletevillages') }}"; 
    $('input.name_villages_receiver').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            var id_distrits=  $("#id_distrits_receiver").val(); 
            return $.get(villages_receiver, { query: query, id_distrits: id_distrits}, function (data) {
                return process(data); 
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_villages_receiver').val(data.id);
        }
    });

 
function go() {
     swal({
            title: "Simpan",
            text: "Pastikan data sudah terisi semua, lanjut simpan ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    goCreateRegistrasi();
                } else {
                   // swal("Transaction Rollback !");
                }
            });
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
    var v_weight = document.getElementById("weight");
    v_weight.addEventListener("keyup", function (e) {
        v_weight.value = formatRupiah(this.value);
    }); 
    var v_size = document.getElementById("size");
    v_size.addEventListener("keyup", function (e) {
        v_size.value = formatRupiah(this.value);
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
//-- hitung 
function calculatePrice() {
   let weight =  price_to_number($("#weight").val()); 
   let price =  price_to_number($("#price").val());
   let price_asuransi =  price_to_number($("#price_asuransi").val()); 
   let grandtotal = 0 ;
   grandtotal = (price*weight)+price_asuransi;
   $("#price_total").val(number_to_price(grandtotal)); 
}
// create
 $( "#form-delivery-transaction" ).submit(function( e ) {
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
                    form_data.append("name_provinces_sender", $("#name_provinces_sender").val());
                    form_data.append("id_provinces_sender", $("#id_provinces_sender").val());
                    form_data.append("name_regencies_sender", $("#name_regencies_sender").val());
                    form_data.append("id_regencies_sender", $("#id_regencies_sender").val());
                    form_data.append("name_distrits_sender", $("#name_distrits_sender").val());
                    form_data.append("id_distrits_sender", $("#id_distrits_sender").val());
                    form_data.append("name_villages_sender", $("#name_villages_sender").val());
                    form_data.append("id_villages_sender", $("#id_villages_sender").val());
                    form_data.append("address_sender", $("#address_sender").val());
                    form_data.append("sender", $("#sender").val());
                    form_data.append("senderphonenumber", $("#senderphonenumber").val());

                    form_data.append("name_provinces_receiver", $("#name_provinces_receiver").val());
                    form_data.append("id_provinces_receiver", $("#id_provinces_receiver").val());
                    form_data.append("name_regencies_receiver", $("#name_regencies_receiver").val());
                    form_data.append("id_regencies_receiver", $("#id_regencies_receiver").val());
                    form_data.append("name_distrits_receiver", $("#name_distrits_receiver").val());
                    form_data.append("id_distrits_receiver", $("#id_distrits_receiver").val());
                    form_data.append("name_villages_receiver", $("#name_villages_receiver").val());
                    form_data.append("id_villages_receiver", $("#id_villages_receiver").val());
                    form_data.append("address_receiver", $("#address_receiver").val());
                    form_data.append("sender_receiver", $("#sender_receiver").val());
                    form_data.append("senderphonenumber_receiver", $("#senderphonenumber_receiver").val());
                    form_data.append("id_transaction_delivery", $("#id_transaction_delivery").val());

                    form_data.append("weight", price_to_number($("#weight").val()));
                    form_data.append("size", price_to_number($("#size").val()));
                    form_data.append("price", price_to_number($("#price").val()));
                    form_data.append("price_asuransi", price_to_number($("#price_asuransi").val()));
                    form_data.append("price_total", price_to_number($("#price_total").val()));
                    form_data.append("id_shippingtype", $("#id_shippingtype").val());
                    form_data.append("id_packet", $("#id_packet").val());
                    form_data.append("transaction_status", $("#transaction_status").val());
                    form_data.append("Description", $("#Description").val());
                    form_data.append("Instruction", $("#Instruction").val());

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/dashboard/delivery/insert",
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
    function backurl() {
        window.location.href = '/dashboard/delivery';
    }
    $(document).ready(function() {
        $(window).keydown(function(event){
            if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
@endsection
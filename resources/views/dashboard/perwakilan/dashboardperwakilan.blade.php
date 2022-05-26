@extends('dashboard.layouts.main')
@section('container')
   <div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">Dashboard Packets - {{ auth()->user()->merchant_id }} ( {{ auth()->user()->level }} )</h6>
              <p>Data Packet base On Merchant in Your Areas.</p>
         </div>
        <div class="card-tools">
            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
        </div>
      </div>
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
              <div class="table-responsive" width="100%">
                <table class="table table-hover">
                    <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">No. Resi Pengiriman</th> 
              <th scope="col">Merchant Name</th> 
              <th scope="col">Status Packet</th> 
              <th scope="col">Provinsi Pengirim</th> 
              <th scope="col">Kabupaten Pengirim</th>
              <th scope="col">Provinsi Penerima</th> 
              <th scope="col">Kabupaten Penerima</th>
              <th scope="col">Nama Paket</th>
              <th scope="col">Jenis Pengiriman</th>
              <th scope="col">Status Pengiriman</th>
              <th scope="col">Berat (Kg)</th> 
              <th scope="col">Ukuran (Kg)</th> 
              <th scope="col">Harga (IDR)</th> 
              <th scope="col">Asuransi (IDR)</th> 
              <th scope="col">Total (IDR)</th>  
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{  $loop->iteration }}</td>
                    <td><a href="/dashboard/delivery/view/{{ $post->id }}" class="badge bg-info">{{  $post->id_transaction_delivery }}</a></td> 
                    <td>{{  $post->merchant_name }}</td>
                    <td>{{  $post->transaction_status }}</td>
                    <td>{{  $post->name_provinces_sender }}</td>
                    <td>{{  $post->name_regencies_sender }}</td>
                    <td>{{  $post->name_provinces_receiver }}</td>
                    <td>{{  $post->name_regencies_receiver }}</td>
                    <td>{{  $post->packet_name }}</td>
                    <td>{{  $post->shipping_type_name }}</td>
                    <td>{{  $post->transaction_status }}</td>
                    <td>{{  $post->weight }}</td>
                    <td>{{  $post->size }}</td>
                    <td>{{  $post->price }}</td>
                    <td>{{  $post->price_asuransi }}</td>
                    <td>{{  $post->price_total }}</td>  
                </tr>
            @endforeach
          </tbody>
                  </table>
              </div>
                <div class="d-flex justify-content-end">
                    {{ $posts->links() }}
                </div>
         
    </div>                                   
  </div>
</div><!-- .col -->
                 

@endsection
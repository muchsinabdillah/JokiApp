@extends('dashboard.layouts.main')
@section('container')
   <div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">Data Pricelist</h6>
              <p>In last 30 days revenue from subscription.</p>
              <a href="/dashboard/pricelist/create" class="btn btn-primary"><em class="icon ni ni-setting"></em><span>New</span></a>
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
                      <th scope="col">Nama Paket</th>  
                      <th scope="col">Provinsi Kirim</th>  
                      <th scope="col">Kabupaten Kirim</th>  
                      <th scope="col">Provinsi Tujuan</th>  
                      <th scope="col">Kelurahan Tujuan</th>  
                      <th scope="col">Harga (Kg)</th>  
                      <th scope="col">Asuransi (Kg)</th>  
                      <th scope="col">Jenis Pengiriman</th>  
                      <th scope="col">Status</th>
                      <th scope="col">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{  $loop->iteration }}</td>
                            <td>{{  $post->packet_name }}</td>  
                            <td>{{  $post->name_provinces_start }}</td>  
                            <td>{{  $post->name_regencies_start }}</td>
                            <td>{{  $post->name_provinces_end }}</td>
                            <td>{{  $post->name_regencies_end }}</td>
                            <td>{{  $post->price }}</td>
                            <td>{{  $post->price_asuransi }}</td>
                            <td>{{  $post->shipping_type_name }}</td>
                            <td>{{  $post->status }}</td>
                            <td>
                                <a href="/dashboard/pricelist/view/{{ $post->id }}" class="badge bg-info"><i class="icon bi bi-eye"></i></a> 
                            </td> 
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
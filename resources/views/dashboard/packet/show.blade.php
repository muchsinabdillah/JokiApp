@extends('dashboard.layouts.main')

@section('container')
<div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">View Data Packet</h6>
              <p>Please Entri Data Packet for Your transaction.</p> 
        </div>
        <div class="card-tools">
            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
        </div>
      </div>
        <form method="POST" action="/dashboard/packet/update"> 
             @csrf
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
                <div class="col-lg-6">
                    <div class="form-group">
                         <label for="id" class="form-label">ID</label> 
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('id') is-invalid @enderror " id="id"
                                name="id" autocomplete="off" readonly value="{{ $merchant->id }}"> 
                                @error('id') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                         <label for="packet_name" class="form-label">Nama Paket</label> 
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('packet_name') is-invalid @enderror " id="packet_name"
                                name="packet_name" autocomplete="off"   autofocus  value="{{ $merchant->packet_name }}"> 
                                @error('packet_name') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="estimasi_time" class="form-label">Estimasi</label> 
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('estimasi_time') is-invalid @enderror " id="estimasi_time"
                                name="estimasi_time" autocomplete="off" placeholder="Ex : 2 hari sampai."   autofocus  value="{{ $merchant->estimasi_time }}"> 
                                @error('estimasi_time') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>      
                <div class="col-lg-6">
                    <div class="form-group">
                       <label for="estimasi_time_days" class="form-label">Estimasi (Days)</label> 
                            <div class="form-control-wrap">
                                <input type="number" class="form-control @error('estimasi_time_days') is-invalid @enderror " id="estimasi_time_days"
                                name="estimasi_time_days" autocomplete="off" placeholder="Ex : 2."   autofocus  value="{{ $merchant->estimasi_time_days }}"> 
                                @error('estimasi_time_days') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                            <div class="form-control-wrap">
                                <select class="form-select" name="status"> 
                                    <option value="{{ $merchant->status }}" selected>{{ $merchant->status }}</option> 
                                    <option value="Active" >Active</option>   
                                    <option value="Stop" >Stop</option>   
                                </select>
                                @error('status') 
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
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
<script >  
    function backurl() {
        window.location.href = '/dashboard/packet';
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
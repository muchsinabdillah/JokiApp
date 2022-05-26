@extends('dashboard.layouts.main')

@section('container')
  <div class="col-lg-12 col-xxl-12">
  <div class="card card-bordered">
    <div class="card-inner">
      <div class="card-title-group align-start mb-2">
        <div class="card-title">
            <h6 class="title">View Data Couriers</h6>
              <p>Pelase Entri Merchants for your transaction.</p> 
        </div>
        <div class="card-tools">
            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
        </div>
      </div>
        <form  method="POST" action="/dashboard/courier/update"> 
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
                                name="id" autocomplete="off" readonly  
                                value="{{ $merchant->ID }}"> 
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
                         <label for="id_register" class="form-label">No. Registrasi</label> 
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('id_register') is-invalid @enderror " id="id_register"
                                name="id_register" autocomplete="off" readonly  
                                value="{{ $merchant->id_register }}"> 
                                @error('id_register') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Name" class="form-label">Nama Courier</label> 
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('Name') is-invalid @enderror " id="Name"
                                name="Name" autocomplete="off"   autofocus  value="{{ $merchant->Name }}"> 
                                @error('Name') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>     
                
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone_number" class="form-label">No. Handphone</label>
                            <div class="form-control-wrap">
                                <input type="number"   class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" autocomplete="off"   value="{{ $merchant->phone_number }}"> 
                                @error('phone_number') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                            <div class="form-control-wrap">
                                <input type="text"   class="form-control @error('email') is-invalid @enderror" id="email" name="email" autocomplete="off"   value="{{ $merchant->email }}"> 
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>      
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                            <div class="form-control-wrap">
                                 @error('address') 
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                    <input id="address" type="hidden" name="address" value="{{ $merchant->address }}">
                                    <trix-editor input="address"></trix-editor>
                            </div>
                    </div>
                </div>     
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_regencies" class="form-label">Kabupaten Name</label>
                            <div class="form-control-wrap">
                               <input type="text"   class="typeahead form-control @error('name_regencies') is-invalid @enderror" id="name_regencies" name="name_regencies" autocomplete="off"   value="{{ $merchant->name_regencies }}"> 
                                @error('name_regencies') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                </div>   
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_regencies" class="form-label">Kabupaten ID</label>
                            <div class="form-control-wrap">
                               <input type="text"  readonly class="form-control @error('id_regencies') is-invalid @enderror" id="id_regencies" name="id_regencies" autocomplete="off"   value="{{ $merchant->id_regencies }}"> 
                                @error('id_regencies') 
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
<script>
    var path = "{{ route('autocomplete') }}"; 
      $('input.typeahead').typeahead({
        int: true,
        highlight: true,
        minLength: 2,
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
                console.log(data);
            });
        },
        //this triggers after a value has been selected on the control
        afterSelect: function (data) {
        //print the id to developer tool's console 
         $('#id_regencies').val(data.id);
        }
    });
    function backurl() {
        window.location.href = '/dashboard/merchant';
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
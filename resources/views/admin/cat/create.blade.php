@extends('layouts.admin.v_main_admin')

@section('title', $title)

@section('styles')
  <!-- DataTables -->
  <link href="{{ asset('dashboard_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('dashboard_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
  
  <!-- Responsive datatable examples -->
  <link href="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('contents')
  @if (\session()->has('message'))
    {!! \session()->get('message') !!}
  @endif
  <div class="page-content">
    <div class="container-fluid">
      
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ $title }}</h4>

          </div>
        </div>
      </div>
      <!-- end page title -->
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card">
        
            <div class="card-body">
              <h4 class="header-title">Tambahkan Data Kucing ke Website</h4>
              <p class="card-title-desc">Data Kucing kegiatan pada {{ getenv('APP_NAME') }}, untuk dilihat oleh pengunjung website.</p>
              <form id="form-add-news" method="post" action="{{ route('dashboard.cat.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <label><span class="text-danger">*</span> Nama Kucing</label>
                    <input type="text" name="name" placeholder="Kimmi.."
                           minlength="3" maxlength="255"
                           value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="col-md-4 mb-4">
                    <label><span class="text-danger">*</span> Jenis Kucing</label>
                    <select name="fk_cat_type" class="form-control @error('fk_cat_type') is-invalid @enderror" id="fk_cat_type" required>
                      @foreach($catTypes as $type)
                        <option value="{{ $type->id }}" @if(old('fk_cat_type') == $type->id) selected @endif>{{ $type->name }}</option>
                      @endforeach
                    </select>
                    @error('fk_cat_type')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="col-md-4 mb-4">
                    <label><span class="text-danger">*</span> Foto Kucing</label>
                    <input type="file" name="image"
                           value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror" required>
                    @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="container">
                  <div class="row">
                    <div class="col text-center">
                      <button class="btn btn-primary" id="btnSubmit" type="submit">Tambahkan Data Kucing</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->
    
    </div> <!-- container-fluid -->
  </div>
  <!-- End Page-content -->
@endsection

@section('scripts')
  <!-- Required datatable js -->
  <script src="{{ asset('dashboard_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection

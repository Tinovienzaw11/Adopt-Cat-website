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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              
              <h4 class="header-title">{{ $title }}</h4>
              <p>List Data Kucing yang sudah ditambahkan</p>
              <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Di Apdopsi Pada</th>
                    <th class="text-center">Dibuat</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                
                
                <tbody>
                
                @foreach($cats as $cat)
                  <tr>
                    <td data-order="{{ $cat->id }}">{{ $cat->id }}</td>
                    <td>
                      {{ $cat->name }}
                    </td>
                    <td class="text-center">
                      @if($cat->status == 'off')
                        <span class="badge badge-secondary">Close Adopt</span>
                      @elseif($cat->status == 'waiting')
                        <span class="badge badge-warning">Menunggu Adopter</span>
                      @else
                        <span class="badge badge-primary">Adopted</span>
                      @endif
                    </td>
                    <td class="text-center">
                      <a href="{{ Storage::url($cat->image) }}" target="_blank">Lihat</a>
                    </td>
                    <td class="text-center">
                      @if(!empty($cat->adopted_at))
                        <span data-toggle="tooltip" data-placement="top" title="{{ \Carbon\Carbon::parse($cat->adpoted_at)->diffForHumans() }}">
                          {{ \Carbon\Carbon::parse($cat->adpoted_at)->format('d-m-Y H:i') }}
                        </span>
                      @else
                        -
                      @endif
                    </td>
                    <td class="text-center">
                      <span data-toggle="tooltip" data-placement="top" title="{{ \Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}">
                        {{ \Carbon\Carbon::parse($cat->created_at)->format('d-m-Y H:i') }}
                      </span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group btn-group-sm mt-1 mr-1 dropright" style="z-index: 999999;">
                        <button type="button" class="btn btn-secondary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="mdi mdi-chevron-down"></i> Pilihan
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('dashboard.cat.edit',['cat' => $cat->id]) }}">Detail Data Kucing</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item btn_delete" data-nama="{{ $cat->name }}"
                             data-href="{{ route('dashboard.cat.destroy', ['cat' => $cat->id]) }}"
                             href="javascript:0;">Hapus Data Kucing</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            
            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
      <!-- end row -->
      
      <!-- end row -->
    
    </div> <!-- container-fluid -->
  </div>
  <!-- End Page-content -->
  <form class="form_delete" action="" method="post">
    @csrf
    @method('delete')
  </form>
@endsection

@section('scripts')
  <!-- Required datatable js -->
  <script src="{{ asset('dashboard_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
  
  <script>
      $(document).ready(function (){
          // let table = $('#datatable').DataTable()
          let table = $('#datatable')

          let t = table.DataTable({
              'order': [ 0, 'desc' ]
          })

          let nama = '';
          table.on('click', '.btn_delete', function (e){
              nama = $(this).data('nama')
              e.preventDefault();
              Swal.fire({
                  title: 'Anda Yakin?',
                  text: 'Hapus Data Kucing ' + nama + ' ?',
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, lanjutkan!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      Swal.fire({
                          title: 'Pertanyaan Terakhir!',
                          text: 'Tidak bisa diulangi!',
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ya, hapus data kucing!',
                          cancelButtonText: 'Batal'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              $('.form_delete').attr('action', $(this).data('href')).submit()
                          }
                      })
                  }
              })
          })
      })
  </script>
@endsection

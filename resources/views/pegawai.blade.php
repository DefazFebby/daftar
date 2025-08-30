<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Laravel 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center" >Data Pegawai</h1>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Kolom Kiri: Search -->
            <div class="d-flex align-items-center gap-2">
                <a href="/tambahpegawai" class="btn btn-primary">Tambah</a>
                <form action="/pegawai" method="GET">
                    <input type="search" name="search" class="form-control" placeholder="Cari pegawai...">
                </form>
            </div>

            <!-- Kolom Kanan: Export -->
            <div class="d-flex gap-2">
                <a href="/exportpdf" class="btn btn-info">Export PDF</a>
                <a href="/exportexcel" class="btn btn-success">Export Excel</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   Import data
                </button>
            </div>
        </div>
        
              <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/importexcel" method="POST" enctype="multipart/form-data">
                  @csrf
                
                  <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
                </form> 
              </div>
            </div>
        <div class="row">
         {{-- @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert">
               {{ $message}}
              </div>       
          @endif --}}
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Foto</th>
      <th scope="col">Alamat</th>
      <th scope="col">Kelamin</th>
      <th scope="col">Telp</th>
      <th scope="col">Dibuat</th>
      <th scope="col">Operasi</th>
    </tr>
  </thead>
  <tbody>
    @php
      $no =1 
    @endphp
    @foreach ($data as $index => $row)
         <tr>
      <th scope="row">{{ $index + $data->firstItem()}}</th>
      <td>{{ $row->nama }}</td>
      <td>
        <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px">
      </td>
      <td>{{ $row->alamat }}</td>
      <td>{{ $row->kelamin }}</td>
      <td>{{ $row->telp }}</td>
      <td>{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('l, d F Y') }}</td>
      <td>
            <form action="{{ route('deletepegawai', $row->id) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger delete-confirm"
                  data-id="{{ $row->id }}"
                  data-nama="{{ $row->nama }}"
                >Hapus</button>
            </form>

          <a href="{{ route('updatepegawai', $row->id) }}" class="btn btn-warning">Edit</a>
          
      </td>    
    </tr>
    @endforeach  

  </tbody>
</table>
{{ $data->links() }}
{{--<a href="{{ route('pegawai.export.pdf') }}" class="btn btn-success mb-3" target="_blank">
    Export PDF
</a>--}}

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </body>

    <script>
        $('.delete-confirm').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const pegawaiId = $(this).data('id');
            const pegawaiNama = $(this).data('nama');
            Swal.fire({
                title: "Apakah kamu yakin?",
                html: "Data dengan <b>ID:</b> <span style='color:blue'>" + pegawaiId + "</span><br>" +
                  "<b>Nama:</b> <span style='color:green'>" + pegawaiNama + "</span><br>" +
                  "akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
      <!-- Toastr Notification -->
    @if(Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    @endif


</html>
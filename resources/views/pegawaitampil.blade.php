<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Laravel 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center" >Tampil Pegawai</h1>
    <div class="container">
        <div class="row justify-content-center" >
          <div class="col-5">
              <div class="card">
            <div class="card-body">
              <form action="/pegawai/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                </div>
                 <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}">
                </div>
                <div class="mb-3">
                    <label for="kelamin" class="form-label">Kelamin</label>
                    <select name="kelamin" id="kelamin" class="form-select" aria-label="Default select example">
                        <option value="L" {{ $data->kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $data->kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                 <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Telp</label>
                  <input type="text" class="form-control"  name="telp" value="{{ $data->telp }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          </div>
        </div>
    </div>                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  </body>
</html>
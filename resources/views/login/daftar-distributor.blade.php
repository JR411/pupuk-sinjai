@extends('login.main')

@section('form')
    <form action="/store" class="signin-form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="checkbox" name="kategori" value="Distributor" checked hidden>
        <div class="form-group mb-3">
            <label class="label" for="username">Username*</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                placeholder="Username" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="password">Password*</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <label class="label" for="password_confirmation">Konfirmasi Password*</label>
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password"
                required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <hr>
        <div class="form-group mb-3">
            <label class="label" for="cv">Nama Perusahan*</label>
            <input type="text" name="cv" class="form-control @error('cv') is-invalid @enderror"
                placeholder="Nama Perusahan" value="{{ old('cv') }}" required>
            @error('cv')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="direktur">Nama Direktur*</label>
            <input type="text" name="direktur" class="form-control @error('direktur') is-invalid @enderror"
                placeholder="Nama Lengkap Direktur" value="{{ old('direktur') }}" required>
            @error('direktur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="alamat">Alamat Lengkap*</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Alamat Lengkap" value="{{ old('alamat') }}" required>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="lokasi_dist">Lokasi Kantor</label>
            <input type="text" name="lokasi_dist" class="form-control @error('lokasi_dist') is-invalid @enderror"
                placeholder="Lokasi Kantor" value="{{ old('lokasi_dist') }}">
            <button type="button" class="btn btn-outline-light text-success p-0" data-bs-toggle="modal"
                data-bs-target="#ket">Keterangan</button>
            @error('lokasi_dist')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="sk">Upload Foto SK Izin*</label>
            <div class="text-center">
                <img class="img-preview img-fluid   my-3">
            </div>
            <input type="hidden" name="oldImg" value="{{ old('sk') }}">
            <input type="file" id="sk" name="sk" accept="image/*"
                class="form-control @error('sk') is-invalid @enderror" style="display: none;" onchange="preview()" required>
            @error('sk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="button" value="Pilih Foto" class="form-control" onclick="HandleBrowseClick();"
                style="background-color: #ACB7BF;" />
            <input type="text" class="form-control" id="filename" disabled />
        </div>
        <div class="form-group mb-3">
            <label class="label" for="no">No HP*</label>
            <input type="text" name="no" class="form-control @error('no') is-invalid @enderror"
                placeholder="No HP (08********)" value="{{ old('no') }}" required>
            @error('no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="rek">No Rekening*</label>
            <input type="text" name="rek" class="form-control @error('rek') is-invalid @enderror"
                placeholder="No Rekening" value="{{ old('rek') }}">
            @error('rek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="bank">Nama Bank*</label>
            <select style="appearance: auto" name="bank" class="form-control @error('bank') is-invalid @enderror">
                <option selected disabled hidden>Pilih Nama Bank</option>
                <option value="BRI">BRI</option>
                <option value="BNI">BNI</option>
                <option value="BCA">BCA</option>
                <option value="Mandiri">Mandiri</option>
            </select>
            @error('bank')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="urea">Harga Pupuk Urea (/Kg)*</label>
            <input type="text" name="urea" class="form-control @error('urea') is-invalid @enderror"
                placeholder="Harga Pupuk Urea (/Kg)" value="{{ old('urea') }}" required>
            @error('urea')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="za">Harga Pupuk ZA (/Kg)*</label>
            <input type="text" name="za" class="form-control @error('za') is-invalid @enderror"
                placeholder="Harga Pupuk ZA (/Kg)" value="{{ old('za') }}" required>
            @error('za')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="npk">Harga Pupuk NPK (/Kg)*</label>
            <input type="text" name="npk" class="form-control @error('npk') is-invalid @enderror"
                placeholder="Harga Pupuk NPK (/Kg)" value="{{ old('npk') }}" required>
            @error('npk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group my-5">
            <button type="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
            <span class="text-danger">Tanda * Wajib Diisi</span>
        </div>
    </form>

    <div class="modal fade" id="ket" tabindex="-1" aria-labelledby="ketLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ketLabel">Keterangan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Cara Memasukkan Maps :</h6>
                    <ol>
                        <li>Buka maps anda</li>
                        <li>salin link lokasi anda</li>
                        <li>masukkan link lokasi yang
                            sudah disalin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function HandleBrowseClick() {
            var fileinput = document.getElementById("sk");
            fileinput.click();
        }

        function preview() {
            const image = document.querySelector('#sk');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

            var fileinput = document.getElementById("sk");
            var textinput = document.getElementById("filename");
            textinput.value = fileinput.files[0].name;
        };
    </script>
@endsection

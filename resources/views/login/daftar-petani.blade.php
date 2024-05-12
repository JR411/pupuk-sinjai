@extends('login.main')

@section('form')
    <form action="/store" class="signin-form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="checkbox" name="kategori" value="Petani" checked hidden>
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
            <label class="label" for="nama">Nama Lengkap*</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
            @error('nama')
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
        <div class="mb-3">
            <label for="desa_id">Nama Desa</label>
            <select name="desa_id" class="form-control" required>
                <option value="" selected disabled hidden>Pilih Desa</option>
                @foreach ($desa as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == old('desa_id') ? 'selected' : '' }}>
                        {{ $item->nama_desa }}</option>
                @endforeach
            </select>
            @error('desa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="nik">NIK*</label>
            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                value="{{ old('nik') }}" required>
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="form-group mb-3">
            <label class="label" for="desa">Nama Desa*</label>
            <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" placeholder="Nama Desa"
                value="{{ old('desa') }}" required>
            @error('desa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="form-group mb-3">
            <label class="label" for="no">No HP*</label>
            <input type="text" name="no" class="form-control @error('no') is-invalid @enderror"
                placeholder="No HP (08********)" value="{{ old('no') }}" required>
            @error('no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="label" for="ktp">Upload Foto KTP*</label>
            <div class="text-center">
                <img class="img-preview img-fluid my-3">
            </div>
            <input type="hidden" name="oldImg" value="{{ old('ktp') }}">
            <input type="file" id="ktp" name="ktp" accept="image/*"
                class="form-control @error('ktp') is-invalid @enderror" style="display: none" onchange="preview()" required>
            @error('ktp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="button" value="Pilih Foto" class="form-control col-5" onclick="HandleBrowseClick();"
                style="background-color: #ACB7BF;" />
            <input type="text" class="form-control" id="filename" disabled />
        </div>

        <div class="form-group my-5">
            <button type="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
            <span class="text-danger">Tanda * Wajib Diisi</span>
        </div>
    </form>
@endsection

@section('js')
    <script>
        function HandleBrowseClick() {
            var fileinput = document.getElementById("ktp");
            fileinput.click();
        }

        function preview() {
            const image = document.querySelector('#ktp');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

            var fileinput = document.getElementById("ktp");
            var textinput = document.getElementById("filename");
            textinput.value = fileinput.files[0].name;
        };
    </script>
@endsection

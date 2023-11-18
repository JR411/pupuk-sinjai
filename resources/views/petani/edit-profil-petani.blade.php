@extends('layouts.petani')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Edit Profil</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                @if ($petani->ket)
                    <label for="ket" class="label mb-1">Alasan Akun Ditolak</label>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $petani->ket }}
                    </div>
                @endif
                @if (session()->has('sukses'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif
                <form action="/petani/{{ $petani->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-xl-6">
                            <label for="nama" class="label mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Nama Lengkap" value="{{ old('nama', $petani->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-6">
                            <label for="alamat" class="label mb-1">Alamat Lengkap</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Alamat Lengkap" value="{{ old('alamat', $petani->alamat) }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-xl-6">
                            <label for="nik" class="label mb-1">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="NIK" value="{{ old('nik', $petani->nik) }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-6">
                            <label for="no" class="label mb-1">No HP</label>
                            <input type="text" name="no" class="form-control @error('no') is-invalid @enderror"
                                placeholder="No HP (08*******)" value="{{ old('no', $petani->no) }}" required>
                            @error('no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <label class="label" for="ktp">Upload Foto KTP</label>
                            <div class="text-center">
                                <img src="/{{ $petani->ktp }}" class="gambar-detail my-3">
                            </div>
                            <input type="hidden" name="oldImg" value="{{ old('ktp', $petani->ktp) }}">
                            <input type="file" id="ktp" name="ktp" accept="image/*"
                                class="form-control @error('ktp') is-invalid @enderror" style="display: none"
                                onchange="preview()">
                            @error('ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="button" value="Pilih Foto" class="form-control" onclick="HandleBrowseClick();" />
                            <input type="text" class="form-control" id="filename" readonly="true" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="/petani" class="btn form-control btn-secondary">Kembali</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn form-control btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

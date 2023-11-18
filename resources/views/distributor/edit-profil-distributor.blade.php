@extends('layouts.distributor')

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
                @if ($distributor->ket)
                    <label for="ket" class="label mb-1">Alasan Akun Ditolak</label>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $distributor->ket }}
                    </div>
                @endif
                @if (session()->has('sukses'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif
                <form action="/distributor/{{ $distributor->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-xl-4">
                            <label for="cv" class="label mb-1">Nama CV</label>
                            <input type="text" name="cv" class="form-control @error('cv') is-invalid @enderror"
                                placeholder="Nama Lengkap" value="{{ old('cv', $distributor->cv) }}" required>
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-4">
                            <label for="no" class="label mb-1">No HP</label>
                            <input type="text" name="no" class="form-control @error('no') is-invalid @enderror"
                                placeholder="No HP (08*******)" value="{{ old('no', $distributor->no) }}" required>
                            @error('no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-4">
                            <label for="rek" class="label mb-1">No Rekening (nama bank)</label>
                            <input type="text" name="rek" class="form-control @error('rek') is-invalid @enderror"
                                placeholder="No Rekening" value="{{ old('rek', $distributor->rek) }}" required>
                            @error('rek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-xl-4">
                            <label for="urea" class="label mb-1">Harga Pupuk Urea (/Kg)</label>
                            <input type="text" name="urea" class="form-control @error('urea') is-invalid @enderror"
                                placeholder="Nama Lengkap" value="{{ old('urea', $distributor->urea) }}" required>
                            @error('urea')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-4">
                            <label for="za" class="label mb-1">Harga Pupuk ZA (/Kg)</label>
                            <input type="text" name="za" class="form-control @error('za') is-invalid @enderror"
                                placeholder="No HP (08*******)" value="{{ old('za', $distributor->za) }}" required>
                            @error('za')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-xl-4">
                            <label for="npk" class="label mb-1">Harga Pupuk NPK (/Kg)</label>
                            <input type="text" name="npk" class="form-control @error('npk') is-invalid @enderror"
                                placeholder="No HP (08*******)" value="{{ old('npk', $distributor->npk) }}" required>
                            @error('npk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <label class="label" for="sk">Upload Foto SK Izin</label>
                            <div class="text-center">
                                <img src="/{{ $distributor->sk }}" class="gambar-detail my-3">
                            </div>
                            <input type="hidden" name="oldImg" value="{{ old('sk', $distributor->sk) }}">
                            <input type="file" id="sk" name="sk" accept="image/*"
                                class="form-control @error('sk') is-invalid @enderror" style="display: none"
                                onchange="preview()">
                            @error('sk')
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
                            <a href="/distributor" class="btn form-control btn-secondary">Kembali</a>
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

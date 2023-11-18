@extends('layouts.informasi')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Tambah Informasi</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                <form action="/informasi-pupuk" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="judul" class="label">Judul Informasi</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Judul Informasi" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi" class="label">Isi Informasi</label>
                        <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" placeholder="Isi dari Informasi"
                            required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="label">Gambar Informasi</label>
                        <input type="hidden" name="oldImg" value="{{ old('gambar') }}">
                        <input type="file" id="gambar" name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror" onchange="preview()">
                        <div class="text-center">
                            <img class="img-preview img-fluid my-3">
                        </div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn form-control btn-primary">Tambah Informasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function preview() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        };
    </script>
@endsection

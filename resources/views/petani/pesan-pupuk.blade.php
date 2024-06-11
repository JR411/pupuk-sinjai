@extends('layouts.petani')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Pesan Pupuk</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                @if ($pesan)
                    @if ($pesan->ket)
                        <label for="ket" class="label mb-1">Alasan Pesanan Ditolak</label>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $pesan->ket }}
                        </div>
                    @endif
                @endif
                <form action="/pesan" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="mb-3">
                        <label for="distributor">Distributor*</label>
                        <select name="distributor_id" class="form-select" required>
                            <option value="" selected disabled hidden>Pilih Distributor</option>
                            @foreach ($distributor as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == old('distributor_id') ? 'selected' : '' }}>
                                    {{ $item->cv }}</option>
                            @endforeach
                        </select>
                        @error('nid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="row">
                        <div class="mb-3 col-xl-6">
                            <label for="alamat">Alamat Lahan*</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Alamat Lengkap Lahan" value="{{ old('alamat') }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-xl-6">
                            <label for="luas">Luas Lahan*</label>
                            <div class="input-group">
                                <input type="text" name="luas"
                                    class="form-control @error('luas') is-invalid @enderror" placeholder="Luas Lahan"
                                    value="{{ old('luas') }}" required>
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @error('luas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="luas">Lokasi</label> --}}
                        {{-- <div id="map" style="width: 100%; height: 30vh;"></div>
                        <input id="lat" type="checkbox" name="lat" value="" checked hidden>
                        <input id="long" type="checkbox" name="long" value="" checked hidden> --}}

                        {{-- <input type="text" class="form-control" name="lokasi"
                            placeholder="Masukkan Lokasi Anda dari Maps">
                        <button type="button" class="btn btn-outline-light text-success p-0" data-bs-toggle="modal"
                            data-bs-target="#ket">Keterangan</button> --}}
                        @php
                            $petani = DB::table('petanis')->where('user_id', Auth::id())->first();
                            $nama_kel = DB::table('wilayah')->where('kode', $petani->kelurahan)->first();

                            $kode = DB::table('valid_lokasis')->where('nama_desa', $petani->kelurahan)->first();
                            $dist = DB::table('distributors')->where('id', $kode->distributor_id)->first();
                            // die(print_r($nama_kel->nama));
                        @endphp
                        <p>Anda berada pada wilayah <b>{{ $nama_kel->nama }}</b> yang distribusi oleh <b>{{ $dist->cv }}</b></p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="lahan">Upload Foto Lahan*</label>
                        <div class="text-center">
                            <img class="img-preview img-fluid my-3">
                        </div>
                        <input type="hidden" name="oldImg" value="{{ old('lahan') }}">
                        <input type="file" id="lahan" name="lahan" accept="image/*"
                            class="form-control @error('lahan') is-invalid @enderror" style="display: none"
                            onchange="preview()" required>
                        @error('lahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="button" value="Pilih Foto" class="form-control col-5"
                            onclick="HandleBrowseClick();" />
                        <input type="text" class="form-control" id="filename" readonly="true" />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="/informasi-pupuk" class="btn form-control btn-secondary">Kembali</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn form-control btn-primary">Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            var fileinput = document.getElementById("lahan");
            fileinput.click();
        }

        function preview() {
            const image = document.querySelector('#lahan');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

            var fileinput = document.getElementById("lahan");
            var textinput = document.getElementById("filename");
            textinput.value = fileinput.files[0].name;
        };
    </script>

    <script>
        // Map initialization
        var map = L.map("map").setView([14.0860746, 100.608406], 7);

        //osm layer
        var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!");
        } else {
            navigator.geolocation.getCurrentPosition(getPosition);
        }

        var marker, circle;

        function getPosition(position) {
            // console.log(position)
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            var accuracy = position.coords.accuracy;

            document.getElementById("lat").value = lat;
            document.getElementById("long").value = long;

            if (marker) {
                map.removeLayer(marker);
            }

            if (circle) {
                map.removeLayer(circle);
            }

            marker = L.marker([lat, long]);
            circle = L.circle([lat, long], {
                radius: accuracy,
            });

            var featureGroup = L.featureGroup([marker, circle], 8).addTo(map);

            map.fitBounds(featureGroup.getBounds());
        }
    </script>
@endsection

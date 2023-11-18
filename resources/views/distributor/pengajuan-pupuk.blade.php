@extends('layouts.distributor')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">
                @if (auth()->user()->status == 'Disetujui')
                    Pengajuan Pupuk
                @else
                    Sedang Diproses
                @endif
            </h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                @if (auth()->user()->status == 'Disetujui')
                    <div class="mx-auto my-3 table-responsive">
                        @if (session()->has('status'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead class="table-secondary text-center align-middle">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat Lahan</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Luas Lahan</th>
                                    <th scope="col">Foto Lahan</th>
                                    <th scope="col">Lokasi Lahan</th>
                                    <th scope="col">Tanggal Permintaan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesan as $item)
                                    @if ($item->petanis)
                                        <tr>
                                            <td class="text-center align-middle">{{ $pesan->firstItem() + $loop->index }}
                                            </td>
                                            <td class="text-center align-middle">{{ $item->petanis->nama }}</td>
                                            <td class="text-center align-middle">{{ $item->alamat }}</td>
                                            <td class="text-center align-middle">{{ $item->petanis->no }}</td>
                                            <td class="text-center align-middle">{{ $item->luas }} m<sup>2</sup></td>
                                            <td class="text-center align-middle"><img id="myImg-{{ $item->petanis->id }}"
                                                    class="myImg" src="/{{ $item->lahan }}"
                                                    alt="Foto Lahan {{ $item->petanis->nama }}"
                                                    style="width:100%;max-width:300px">
                                            </td>
                                            <td class="text-center align-middle">
                                                {!! $item->lokasi !!}
                                                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.545680511986!2d119.4290309798356!3d-5.176518781395466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee289786b5bb5%3A0x917a63b2f22cc810!2sUIN%20Alauddin%20Makassar%20Kampus%201!5e0!3m2!1sid!2sid!4v1687003053768!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                            </td>
                                            <td class="text-center align-middle">{{ $item->created_at->format('j M Y') }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <form action="/pesan/{{ $item->id }}" method="post" class="d-inline">
                                                    @method('put')
                                                    @csrf
                                                    <input type="checkbox" name="status" value="Diterima" checked hidden>
                                                    <button type="submit" class="btn btn-success"
                                                        onclick="return confirm('Terima Pengajuan Pupuk Oleh {{ $item->petanis->nama }}')">Terima</button>
                                                </form>
                                                <button type="button" class="btn btn-danger my-1" data-bs-toggle="modal"
                                                    data-bs-target="#tolak{{ $item->petanis->id }}">Tolak</button>
                                            </td>
                                        </tr>
                                        <div id="myModal-{{ $item->petanis->id }}" class="gambar">
                                            <span class="close-{{ $item->petanis->id }} tutup">&times;</span>
                                            <img class="gambar-content" id="img-{{ $item->petanis->id }}">
                                            <div id="caption-{{ $item->petanis->id }}" class="caption"></div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body d-flex justify-content-center mt-5">
                        <img src="/img/seru-biru.png" alt="" width="65px">
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <h3 class="mt-3 text-primary">Data Akun Sedang Diproses</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @foreach ($pesan as $item)
        @if ($item->petanis)
            <div class="modal fade" id="tolak{{ $item->petanis->id }}" tabindex="-1"
                aria-labelledby="tolakLabel{{ $item->petanis->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tolakLabel{{ $item->petanis->id }}">Tolak Pengajuan Pupuk Oleh
                                {{ $item->petanis->nama }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/pesan/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="ket" class="label mb-1">Alasan Pengajuan Pupuk Ditolak</label>
                                    <textarea name="ket" class="form-control @error('ket') is-invalid @enderror" rows="7"
                                        placeholder="Harap Diisi" required></textarea>
                                    @error('ket')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <input type="checkbox" name="status" value="Ditolak" checked hidden>
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('js')
    @foreach ($pesan as $item)
        @if ($item->petanis)
            <script>
                var modal = document.getElementById('myModal-{{ $item->petanis->id }}');

                var img = document.getElementById('myImg-{{ $item->petanis->id }}');
                var modalImg = document.getElementById('img-{{ $item->petanis->id }}');
                var captionText = document.getElementById('caption-{{ $item->petanis->id }}');
                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                var span = document.getElementsByClassName('close-{{ $item->petanis->id }}')[0];

                span.onclick = function() {
                    modal.style.display = "none";
                }
            </script>

            {{-- <script>
                // Map initialization
                var map{{ $item->id }} = L.map("map").setView([{{ $item->lat }}, {{ $item->long }}], 17);

                //osm layer
                var osm{{ $item->id }} = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                });
                osm{{ $item->id }}.addTo(map{{ $item->id }});

                var marker{{ $item->id }}, circle{{ $item->id }};

                function getPosition(position) {
                    // console.log(position)
                    var lat{{ $item->id }} = {{ $item->lat }};
                    var long{{ $item->id }} = {{ $item->long }};
                    var accuracy{{ $item->id }} = 0;

                    if (marker{{ $item->id }}) {
                        map.removeLayer(marker{{ $item->id }});
                    }

                    if (circle{{ $item->id }}) {
                        map.removeLayer(circle{{ $item->id }});
                    }

                    marker{{ $item->id }} = L.marker([lat, long]);
                    circle{{ $item->id }} = L.circle([lat, long], {
                        radius: accuracy{{ $item->id }},
                    });

                    var featureGroup{{ $item->id }} = L.featureGroup([marker{{ $item->id }}, circle{{ $item->id }}],
                        8).addTo(map{{ $item->id }});

                    map{{ $item->id }}.fitBounds(featureGroup{{ $item->id }}.getBounds());
                }
            </script> --}}
        @endif
    @endforeach
@endsection

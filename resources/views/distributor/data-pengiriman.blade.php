@extends('layouts.distributor')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Data Pengiriman</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                <div class="mx-auto my-3 table-responsive">
                    @if (session()->has('status'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Nama</th>
                                <th scope="col" rowspan="2">Alamat Lahan</th>
                                <th scope="col" rowspan="2">Lokasi Lahan</th>
                                <th scope="col" rowspan="2">No HP</th>
                                <th scope="col" colspan="3">Pupuk</th>
                                <th scope="col" rowspan="2">Total Harga</th>
                                <th scope="col" rowspan="2">Tanggal Permintaan</th>
                                <th scope="col" rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2">Urea</th>
                                <th scope="col" rowspan="2">ZA</th>
                                <th scope="col" rowspan="2">NPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesan as $item)
                                @if ($item->petanis)
                                    @php
                                        $pupuk_urea = (100 / 41) * 20 * ($item->luas / 10000);
                                        $pupuk_za = (100 / 21) * 10 * ($item->luas / 10000);
                                        $pupuk_npk = (100 / 15) * 10 * ($item->luas / 10000);

                                        $pupuk_urea = ceil($pupuk_urea);
                                        $pupuk_za = ceil($pupuk_za);
                                        $pupuk_npk = ceil($pupuk_npk);

                                        $harga_urea = $pupuk_urea * $item->distributors->urea;
                                        $harga_za = $pupuk_za * $item->distributors->za;
                                        $harga_npk = $pupuk_npk * $item->distributors->npk;

                                        $total = $harga_urea + $harga_za + $harga_npk;
                                    @endphp
                                    <tr>
                                        <td class="text-center align-middle">{{ $pesan->firstItem() + $loop->index }}
                                        </td>
                                        <td class="text-center align-middle">{{ $item->petanis->nama }}</td>
                                        <td class="text-center align-middle">{{ $item->alamat }}</td>
                                        <td class="text-center align-middle">
                                            {!! $item->lokasi !!}
                                        </td>
                                        <td class="text-center align-middle">{{ $item->petanis->no }}</td>
                                        <td class="text-center align-middle">{{ $pupuk_urea }} Kg</td>
                                        <td class="text-center align-middle">{{ $pupuk_za }} Kg</td>
                                        <td class="text-center align-middle">{{ $pupuk_npk }} Kg</td>
                                        <td class="text-center align-middle">@rupiah($total)</td>
                                        <td class="text-center align-middle">{{ $item->created_at->format('j M Y') }} </td>
                                        <td class="text-center align-middle">
                                            @if ($item->kirim)
                                                <form action="/pesan/{{ $item->id }}" method="post" class="d-inline">
                                                    @method('put')
                                                    @csrf
                                                    <input type="checkbox" name="selesai" value="1" checked hidden>
                                                    <button type="submit" class="btn btn-success"
                                                        onclick="return confirm('Pupuk {{ $item->petanis->nama }} Sudah Sampai')">Selesai</button>
                                                </form>
                                            @elseif ($item->bayar)
                                                <form action="/pesan/{{ $item->id }}" method="post" class="d-inline">
                                                    @method('put')
                                                    @csrf
                                                    <input type="checkbox" name="kirim" value="1" checked hidden>
                                                    <button type="submit" class="btn btn-info"
                                                        onclick="return confirm('Kirim Pupuk {{ $item->petanis->nama }}')">Kirim</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
    @foreach ($pesan as $item)
        <script>
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
        </script>
    @endforeach
@endsection --}}

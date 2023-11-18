@extends('layouts.petani')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Data Distributor</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                <div class="col-11 mx-auto my-3 table-responsive">
                    @if (session()->has('kirim'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('kirim') }}
                        </div>
                    @elseif (session()->has('sukses'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('sukses') }}
                        </div>
                    @endif
                    <form class="d-flex">
                        <input class="form-control mb-4" type="text" name="search" value="{{ $search }}"
                            placeholder="Cari Data" aria-label="Search">
                        <button class="btn btn-info mb-4" type="submit">Cari</button>
                    </form>
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">CV Distributor</th>
                                <th scope="col" rowspan="2">SK Izin</th>
                                <th scope="col" rowspan="2">Lokasi Kantor</th>
                                <th scope="col" colspan="3">Harga Pupuk (/Kg)</th>
                                <th scope="col" rowspan="2">No.Hp Distributor</th>
                            </tr>
                            <tr>
                                <th scope="col">Urea</th>
                                <th scope="col">ZA</th>
                                <th scope="col">NPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributor as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $distributor->firstItem() + $loop->index }}</td>
                                    <td class="text-center align-middle">{{ $item->cv }}</td>
                                    <td class="text-center align-middle"><img id="myImg-{{ $item->id }}" class="myImg"
                                            src="/{{ $item->sk }}" alt="Foto SK Izin {{ $item->cv }}"
                                            style="width:100%;max-width:300px">
                                    </td>
                                    <td class="text-center align-middle">{!! $item->lokasi_dist !!}</td>
                                      <td class="text-center align-middle">@rupiah($item->urea)</td>
                                    <td class="text-center align-middle">@rupiah($item->za)</td>
                                    <td class="text-center align-middle">@rupiah($item->npk)</td><td class="text-center align-middle">{{ $item->no }}</td>

                                </tr>
                                <div id="myModal-{{ $item->id }}" class="gambar">
                                    <span class="close-{{ $item->id }} tutup">&times;</span>
                                    <img class="gambar-content" id="img-{{ $item->id }}">
                                    <div id="caption-{{ $item->id }}" class="caption"></div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @foreach ($distributor as $item)
        <script>
            var modal = document.getElementById('myModal-{{ $item->id }}');

            var img = document.getElementById('myImg-{{ $item->id }}');
            var modalImg = document.getElementById('img-{{ $item->id }}');
            var captionText = document.getElementById('caption-{{ $item->id }}');
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            var span = document.getElementsByClassName('close-{{ $item->id }}')[0];

            span.onclick = function() {
                modal.style.display = "none";
            }
        </script>
    @endforeach
@endsection

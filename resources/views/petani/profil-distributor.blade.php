@extends('layouts.petani')

@section('card')
    <div class="row">
        <div class="text-start">
            {{-- <h3 class="mt-5 text-white">Data Distributor Desa {{ $petani->desas->nama_desa }}</h3> --}}
            <h3 class="mt-5 text-white">Data Distributor Desa {{ $nama_kel->nama }}</h3>
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
                    {{-- <form class="d-flex">
                        <input class="form-control mb-4" type="text" name="search" value="{{ $search }}"
                            placeholder="Cari Data" aria-label="Search">
                        <button class="btn btn-info mb-4" type="submit">Cari</button>
                    </form> --}}
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Nama Distributor</td>
                                <td colspan="2">{{ $distributor->cv }}</td>
                            </tr>
                            <tr>
                                <td>Nama Direktur</td>
                                <td colspan="2">{{ $distributor->direktur }}</td>
                            </tr>
                            <tr>
                                <td>No.HP Distributor</td>
                                <td colspan="2">{{ $distributor->no }}</td>
                            </tr>
                            <tr>
                                <td>SK Izin</td>
                                <td colspan="2"><img id="myImg-{{ $distributor->id }}" class="myImg"
                                        src="/{{ $distributor->sk }}" alt="Foto KTP {{ $distributor->cv }}"
                                        style="width:100%;max-width:300px">
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi Kantor</td>
                                <td colspan="2">{!! $distributor->lokasi_dist !!}</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Harga Pupuk (/Kg) :</td>
                                <td>Urea</td>
                                <td>@rupiah($distributor->urea)</td>
                            </tr>
                            <tr>
                                <td>ZA</td>
                                <td>@rupiah($distributor->za)</td>
                            </tr>
                            <tr>
                                <td>NPK</td>
                                <td>@rupiah($distributor->npk)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var modal = document.getElementById('myModal-{{ $distributor->id }}');

        var img = document.getElementById('myImg-{{ $distributor->id }}');
        var modalImg = document.getElementById('img-{{ $distributor->id }}');
        var captionText = document.getElementById('caption-{{ $distributor->id }}');
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        var span = document.getElementsByClassName('close-{{ $distributor->id }}')[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
@endsection

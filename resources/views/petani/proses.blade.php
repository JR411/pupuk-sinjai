@extends('layouts.petani')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">
                @if ($pesan->selesai)
                    Pesanan Sampai
                @elseif ($pesan->kirim)
                    Pesanan Dikirim
                @elseif ($pesan->bayar)
                    Bayar Pupuk
                @elseif ($pesan->status == 'Diterima')
                    Pesanan Pupuk
                @else
                    Data Diproses
                @endif
            </h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                @if ($pesan->selesai)
                    <div class="card-body d-flex justify-content-center mt-5">
                        <img src="/img/seru-biru.png" alt="" width="65px">
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <h3 class="mt-3 text-primary">Pesanan Sudah Sampai</h3>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="/petani" class="btn btn-primary py-1 px-4 me-3 my-2">Pesan Lagi</a>
                        </div>
                    </div>
                @elseif ($pesan->kirim)
                    <div class="card-body d-flex justify-content-center mt-5">
                        <img src="/img/seru-biru.png" alt="" width="65px">
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <h3 class="mt-3 text-primary">Pesanan Sedang Dikirim</h3>
                    </div>
                @elseif ($pesan->bayar)
                    @php
                        $pupuk_urea = (100 / 41) * 20 * ($pesan->luas / 10000);
                        $pupuk_za = (100 / 21) * 10 * ($pesan->luas / 10000);
                        $pupuk_npk = (100 / 15) * 10 * ($pesan->luas / 10000);

                        $pupuk_urea = ceil($pupuk_urea);
                        $pupuk_za = ceil($pupuk_za);
                        $pupuk_npk = ceil($pupuk_npk);

                        $harga_urea = $pupuk_urea * $pesan->distributors->urea;
                        $harga_za = $pupuk_za * $pesan->distributors->za;
                        $harga_npk = $pupuk_npk * $pesan->distributors->npk;

                        $total = $harga_urea + $harga_za + $harga_npk;
                    @endphp
                    <div class="col-11 mx-auto my-3">
                        <div class="row">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>Nama Bank</td>
                                        <td>{{ $pesan->distributors->bank }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td>{{ $pesan->distributors->rek }}</td>
                                    </tr>
                                    <tr>
                                        <td>Hubungi Nomor</td>
                                        <td>{{ $pesan->distributors->no }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Total Bayar</td>
                                        <td class="fw-bold">@rupiah($total)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($pesan->status == 'Diterima')
                    @php
                        $pupuk_urea = (100 / 41) * 20 * ($pesan->luas / 10000);
                        $pupuk_za = (100 / 21) * 10 * ($pesan->luas / 10000);
                        $pupuk_npk = (100 / 15) * 10 * ($pesan->luas / 10000);

                        $pupuk_urea = ceil($pupuk_urea);
                        $pupuk_za = ceil($pupuk_za);
                        $pupuk_npk = ceil($pupuk_npk);

                        $harga_urea = $pupuk_urea * $pesan->distributors->urea;
                        $harga_za = $pupuk_za * $pesan->distributors->za;
                        $harga_npk = $pupuk_npk * $pesan->distributors->npk;

                        $total = $harga_urea + $harga_za + $harga_npk;
                    @endphp
                    <div class="col-11 mx-auto my-3">
                        <table class="table table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Nama Pupuk</th>
                                    <th scope="col">Jumlah (/Kg)</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Urea</td>
                                    <td>{{ $pupuk_urea }} Kg</td>
                                    <td>@rupiah($harga_urea)</td>
                                </tr>
                                <tr>
                                    <td>ZA</td>
                                    <td>{{ $pupuk_za }} Kg</td>
                                    <td>@rupiah($harga_za)</td>
                                </tr>
                                <tr>
                                    <td>NPK</td>
                                    <td>{{ $pupuk_npk }} Kg</td>
                                    <td>@rupiah($harga_npk)</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="fw-bold">Total Bayar</td>
                                    <td class="fw-bold">@rupiah($total)</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-end">
                                <form action="/pesan/{{ $pesan->id }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="checkbox" name="bayar" value="1" checked hidden>
                                    <button type="submit" class="btn btn-primary py-1 px-4 me-3 my-2">Bayar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-body d-flex justify-content-center mt-5">
                        <img src="/img/seru-biru.png" alt="" width="65px">
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <h3 class="mt-3 text-primary">Pesanan Sedang Diproses</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

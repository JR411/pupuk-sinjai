@extends('layouts.pemerintah')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Data Penjualan</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                <div class="col-11 mx-auto my-3 table-responsive">
                    <form class="d-flex">
                        <input class="form-control mb-4" type="text" name="search" value="{{ $search }}"
                            placeholder="Cari Data" aria-label="Search">
                        <button class="btn btn-info mb-4" type="submit">Cari</button>
                    </form>
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Nama Petani</th>
                                <th scope="col" rowspan="2">No.Hp Petani</th>
                                <th scope="col" rowspan="2">Distributor</th>
                                <th scope="col" rowspan="2">Direktur</th>
                                <th scope="col" rowspan="2">No.Hp Distributor</th>
                                <th scope="col" rowspan="2">Alamat</th>
                                <th scope="col" colspan="3">Pupuk (kg)</th>
                                <th scope="col" rowspan="2">Total Harga</th>
                                <th scope="col" rowspan="2">Status</th>
                                <th scope="col" rowspan="2">Ket</th>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2">Urea</th>
                                <th scope="col" rowspan="2">ZA</th>
                                <th scope="col" rowspan="2">NPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesan as $item)
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
                                    <td class="text-center align-middle">{{ $pesan->firstItem() + $loop->index }}</td>
                                    <td class="text-center align-middle">{{ $item->petanis->nama }}</td>
                                    <td class="text-center align-middle">{{ $item->petanis->no }}</td>
                                    <td class="text-center align-middle">{{ $item->distributors->cv }}</td>
                                    <td class="text-center align-middle">{{ $item->distributors->direktur }}</td>
                                    <td class="text-center align-middle">{{ $item->distributors->no }}</td>
                                    <td class="text-center align-middle">{{ $item->alamat }}</td>
                                    <td class="text-center align-middle">{{ $pupuk_urea }} kg</td>
                                    <td class="text-center align-middle">{{ $pupuk_za }} kg</td>
                                    <td class="text-center align-middle">{{ $pupuk_npk }} kg</td>
                                    <td class="text-center align-middle">@rupiah($total)</td>
                                    <td class="text-center align-middle">
                                        @if ($item->selesai)
                                            Selesai
                                        @elseif ($item->kirim)
                                            Dikirim
                                        @elseif ($item->bayar)
                                            Dibayar
                                        @elseif ($item->status)
                                            {{ $item->status }}
                                        @else
                                            Sedang Diproses
                                        @endif
                                    </td>
                                    @if ($item->status == 'Ditolak')
                                        <td class="text-center align-middle">{{ $item->ket }}</td>
                                    @else
                                        <td class="text-center align-middle">-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.pemerintah')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Data Desa</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                <div class="mx-auto my-3 table-responsive">
                    @if (session()->has('sukses'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('sukses') }}
                        </div>
                    @endif
                    <a href="/pemerintah/data-desa/create" class="btn btn-info mb-3">Tambah Desa</a>
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Desa</th>
                                <th scope="col">Distributor</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($kode as $item)
                                <tr>
                                    {{-- <td class="text-center align-middle">{{ $desa->firstItem() + $loop->index }}</td> --}}
                                    <td class="text-center align-middle">{{ $i }}</td>
                                    @php
                                        $nama_kel = DB::table('wilayah')
                                            ->where('kode', $item->nama_desa)
                                            ->first();
                                        // die(print_r($nama_kel));
                                    @endphp
                                    <td class="text-center align-middle">{{ $nama_kel->nama }}</td>

                                    @php
                                        $dist = DB::table('distributors')
                                            ->where('id', $item->distributor_id)
                                            ->first();
                                        // die(print_r($nama_kel));
                                    @endphp
                                    <td class="text-center align-middle">{{ $dist->cv }}</td>
                                    <td class="text-center align-middle">
                                        {{-- <button type="button" class="badge bg-warning text-white px-2 py-2 border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDesa-{{ $item->id }}">Edit</button> --}}
                                        <form action="/pemerintah/data-desa/{{ $item->id }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0 px-2 py-2 my-1"
                                                onclick="return confirm('Hapus Desa {{ $nama_kel->nama }}?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $desa->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('modal')
    @foreach ($desa as $item)
        <div class="modal fade" id="editDesa-{{ $item->id }}" tabindex="-1" aria-labelledby="editDesaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editDesaLabel">Edit Desa {{ $item->username }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pemerintah/data-desa/{{ $item->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_desa" class="label">Nama Desa</label>
                                <input type="text" name="nama_desa"
                                    class="form-control @error('nama_desa') is-invalid @enderror" placeholder="Nama Desa"
                                    value="{{ old('nama_desa', $item->nama_desa) }}" required>
                                @error('nama_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="distributor_id">Distributor</label>
                                <select name="distributor_id" class="form-select" required>
                                    <option value="" selected disabled hidden>Pilih Distributor</option>
                                    @foreach ($distributor as $item2)
                                        <option value="{{ $item2->id }}"
                                            {{ $item2->id == old('distributor_id') || $item2->id == $item->distributor_id ? 'selected' : '' }}>
                                            {{ $item2->cv }}</option>
                                    @endforeach
                                </select>
                                @error('distributor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-warning text-white">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection --}}

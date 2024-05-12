@extends('layouts.informasi')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Tambah Desa</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                <form action="/pemerintah/data-desa" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama_desa" class="label">Nama Desa</label>
                        <input type="text" name="nama_desa" class="form-control @error('nama_desa') is-invalid @enderror"
                            placeholder="Nama Desa" value="{{ old('nama_desa') }}" required>
                        @error('nama_desa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="distributor_id">Distributor</label>
                        <select name="distributor_id" class="form-select" required>
                            <option value="" selected disabled hidden>Pilih Distributor</option>
                            @foreach ($distributor as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == old('distributor_id') ? 'selected' : '' }}>
                                    {{ $item->cv }}</option>
                            @endforeach
                        </select>
                        @error('distributor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn form-control btn-primary">Tambah Desa</button>
                </form>
            </div>
        </div>
    </div>
@endsection

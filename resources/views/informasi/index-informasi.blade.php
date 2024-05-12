@extends('layouts.informasi')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Informasi Pupuk</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 my-5">
            <div class="card-body">
                @if (session()->has('sukses'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif
                @if (Auth()->user()->kategori == 'Pemerintah')
                    <a href="/informasi-pupuk/create" class="btn btn-info">Tambah Informasi</a>
                @endif
                <div class="row mb-3">
                    @foreach ($informasi as $item)
                        @if ($item->gambar)
                            <img src="/{{ $item->gambar }}" class="my-3 gambar-info" alt="">
                        @else
                            <img src="/img/info.png" class="my-3 gambar-info" alt="">
                        @endif
                        <h3 class="my-2">{{ $item->judul }} <a href="/informasi-pupuk/{{ $item->slug }}"
                                class="btn btn-outline-primary mx-3">Detail Berita</a></h3>
                        <span class="d-block my-1">{{ $item->kutipan }}</span>
                    @endforeach
                </div>
            </div>
            {{ $informasi->links() }}
        </div>
    </div>
@endsection

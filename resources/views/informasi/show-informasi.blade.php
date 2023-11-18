@extends('layouts.informasi')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">{{ $informasi->judul }}</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 my-5">
            <div class="card-body">
                <div class="d-inline-flex">
                    <a href="/informasi-pupuk" class="btn btn-info text-white">Kembali</a>
                    @if (Auth()->user()->kategori == 'Pemerintah')
                        <a href="/informasi-pupuk/{{ $informasi->slug }}/edit" class="btn btn-warning text-white mx-2">Edit
                            Informasi Ini</a>
                        {{-- <a href="/informasi-pupuk" class="btn btn-danger">Hapus Informasi Ini</a> --}}
                        <form action="/informasi-pupuk/{{ $informasi->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger text-white"
                                onclick="return confirm('Hapus Informasi ({{ $informasi->judul }})?')">Hapus Informasi
                                Ini</button>
                        </form>
                    @endif
                </div>
                <div class="mx-auto col-11 text-center">
                    @if ($informasi->gambar)
                        <img src="/{{ $informasi->gambar }}" class="my-3 gambar-detail" alt="">
                    @else
                        <img src="/img/info.png" class="my-3 gambar-detail" alt="">
                    @endif
                </div>
            </div>
            <h3 class="my-3 mx-auto col-11">{{ $informasi->judul }}</h3>
            <span class="my-3 mx-auto col-11">{{ $informasi->isi }}</span>
        </div>
    </div>
@endsection

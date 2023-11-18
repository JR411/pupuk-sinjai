@extends('layouts.pemerintah')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Validasi Distributor</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body">
                <div class="mx-auto my-3 table table-responsive">
                    @if (session()->has('status'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">CV</th>
                                <th scope="col">No HP</th>
                                <th scope="col">SK Izin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributor as $item)
                                @if ($item->distributors)
                                    <tr>
                                        <td class="text-center align-middle">{{ $distributor->firstItem() + $loop->index }}
                                        </td>
                                        <td class="text-center align-middle">{{ $item->distributors->cv }}</td>
                                        <td class="text-center align-middle">{{ $item->distributors->no }}</td>
                                        <td class="text-center align-middle"><img id="myImg-{{ $item->distributors->id }}"
                                                class="myImg" src="/{{ $item->distributors->sk }}"
                                                alt="Foto SK {{ $item->distributors->cv }}"
                                                style="width:100%;max-width:300px">
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="/distributor/{{ $item->distributors->id }}" method="post"
                                                class="d-inline">
                                                @method('put')
                                                @csrf
                                                <input type="checkbox" name="status" value="Disetujui" checked hidden>
                                                <button type="submit" class="btn btn-success my-1"
                                                    onclick="return confirm('Setuju Akun {{ $item->distributors->cv }} Sebagai Akun {{ $item->kategori }}')">Setuju</button>
                                            </form>
                                            <button type="button" class="btn btn-danger my-1" data-bs-toggle="modal"
                                                data-bs-target="#tolak{{ $item->distributors->id }}">Tolak</button>
                                        </td>
                                    </tr>
                                    <div id="myModal-{{ $item->distributors->id }}" class="gambar">
                                        <span class="close-{{ $item->distributors->id }} tutup">&times;</span>
                                        <img class="gambar-content" id="img-{{ $item->distributors->id }}">
                                        <div id="caption-{{ $item->distributors->id }}" class="caption"></div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @foreach ($distributor as $item)
        @if ($item->distributors)
            <div class="modal fade" id="tolak{{ $item->distributors->id }}" tabindex="-1"
                aria-labelledby="tolakLabel{{ $item->distributors->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tolakLabel{{ $item->distributors->id }}">Tolak Akun
                                {{ $item->distributors->cv }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/distributor/{{ $item->distributors->id }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="ket" class="label mb-1">Alasan Akun Ditolak</label>
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
    @foreach ($distributor as $item)
        @if ($item->distributors)
            <script>
                var modal = document.getElementById('myModal-{{ $item->distributors->id }}');

                var img = document.getElementById('myImg-{{ $item->distributors->id }}');
                var modalImg = document.getElementById('img-{{ $item->distributors->id }}');
                var captionText = document.getElementById('caption-{{ $item->distributors->id }}');
                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                var span = document.getElementsByClassName('close-{{ $item->distributors->id }}')[0];

                span.onclick = function() {
                    modal.style.display = "none";
                }
            </script>
        @endif
    @endforeach
@endsection

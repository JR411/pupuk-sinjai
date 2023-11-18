@extends('layouts.pemerintah')

@section('card')
    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Data Akun</h3>
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
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary text-center align-middle">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($user as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $user->firstItem() + $loop->index }}</td>
                                    <td class="text-center align-middle">{{ $item->username }}</td>
                                    <td class="text-center align-middle">{{ $item->kategori }}</td>
                                    <td class="text-center align-middle">{{ $item->status }}</td>
                                    <td class="text-center align-middle">
                                        <button type="button" class="badge bg-warning text-white px-2 py-2 border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editAkun-{{ $item->id }}">Edit</button>
                                        <form action="/pemerintah/akun/{{ $item->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0 px-2 py-2 my-1"
                                                onclick="return confirm('Hapus Akun {{ $item->username }} Sebagai Akun {{ $item->kategori }}?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @foreach ($semua as $item)
        <div class="modal fade" id="editAkun-{{ $item->id }}" tabindex="-1" aria-labelledby="editAkunLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAkunLabel">Edit Akun {{ $item->username }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pemerintah/akun/{{ $item->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username" class="label">Username</label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                    value="{{ old('username', $item->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    value="{{ old('password') }}" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label class="label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Konfirmasi Password" required>
                                @error('password_confirmation')
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
@endsection

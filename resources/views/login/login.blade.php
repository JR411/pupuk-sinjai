@extends('login.main')

@section('form')
    @if (session()->has('Gagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('Gagal') }}
        </div>
    @elseif (session()->has('Sukses'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('Sukses') }}
        </div>
    @endif

    <form action="/autentikasi" class="signin-form" method="post">
        @csrf
        <div class="form-group mb-3">
            <label class="label" for="username">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group mb-5">
            <label class="label" for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group my-1 mx-auto d-flex justify-content-center" style="width: 50%">
            <button type="submit" class="form-control btn btn-primary submit px-3">Masuk</button>
        </div>
    </form>
@endsection

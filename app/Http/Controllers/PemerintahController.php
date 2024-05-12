<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemerintahController extends Controller
{
    public function index()
    {
        $user = User::orderByDesc('updated_at')->where('id', 'not like', Auth::id())->paginate(10)->withQueryString();
        $semua = User::all()->except(Auth::id());
        $pemerintah = User::where('id', Auth::id())->first();

        return view('pemerintah.data-akun')->with(compact('user', 'semua', 'pemerintah'));
    }

    // public function petani()
    // {
    //     $petani = User::with('petanis')->orderByDesc('updated_at')->where('status', 'Sedang Diproses')->where('kategori', 'Petani')->paginate(10)->withQueryString();
    //     $pemerintah = User::where('id', Auth::user()->id)->first();

    //     return view('pemerintah.validasi-petani')->with(compact('petani', 'pemerintah'));
    // }

    // public function distributor()
    // {
    //     $distributor = User::with('distributors')->orderByDesc('updated_at')->where('status', 'Sedang Diproses')->where('kategori', 'Distributor')->paginate(10)->withQueryString();
    //     $pemerintah = User::where('id', Auth::user()->id)->first();

    //     return view('pemerintah.validasi-distributor')->with(compact('distributor', 'pemerintah'));
    // }

    public function riwayat(Request $request)
    {
        $pesan = Pesan::with(['petanis', 'distributors'])->orderByDesc('updated_at')->pemerintah(request(['search']))->paginate(10)->withQueryString();
        $pemerintah = User::where('id', Auth::user()->id)->first();
        $search = $request->search;

        return view('pemerintah.riwayat-pesanan-pemerintah')->with(compact('pesan', 'pemerintah', 'search'));
    }
}

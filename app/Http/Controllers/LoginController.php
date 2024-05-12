<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Image;
use App\Models\Distributor;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function autentikasi(Request $request)
    {
        $tes = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($tes)) {
            $request->session()->regenerate();
            return redirect()->intended('/informasi-pupuk');
        }

        return back()->with('Gagal', 'Login Gagal');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function petani()
    {
        if (Auth::user()) {
            return redirect()->intended('/informasi-pupuk');
        }

        $desa = Desa::orderBy('nama_desa')->get();

        return view('login.daftar-petani')->with(compact('desa'));
    }

    public function distributor()
    {
        if (Auth::user()) {
            return redirect()->intended('/informasi-pupuk');
        }

        return view('login.daftar-distributor');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:3',
            'kategori' => ''
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->password = Hash::make($validated['password']);
        $user->kategori = $validated['kategori'];
        // $user->status = 'Sedang Diproses';

        if ($user->kategori == 'Petani') {
            $valid = $request->validate([
                'nama' => 'required|min:3',
                'alamat' => 'required|min:3',
                'desa_id' => 'required',
                'nik' => 'required|numeric|digits:16',
                'no' => 'required|numeric|required|regex:/(08)[0-9]/|digits_between:10,13',
                'ktp' => 'required|image|file|max:2048'
            ]);

            $gambar = $request->ktp;
            $new_gambar = time() . ' ' . $request->nama . '.png';
            Image::make($gambar)->save('img/foto-ktp/' . $new_gambar, 100, 'png');

            $petani = new Petani();
            $petani->nama = $valid['nama'];
            $petani->alamat = $valid['alamat'];
            $petani->desa_id = $valid['desa_id'];
            $petani->nik = $valid['nik'];
            $petani->no = $valid['no'];
            $petani->ktp = 'img/foto-ktp/' . $new_gambar;
            $user->save();
            $petani->user_id = $user->id;
            $petani->save();

            return redirect('/')->with('Sukses', 'Akun Petani Telah Dibuat Silahkan Login');
        } elseif ($user->kategori == 'Distributor') {
            $valid = $request->validate([
                'lokasi_dist' => '',
                'alamat' => 'required|min:3',
                'cv' => 'required|min:3',
                'direktur' => 'required|min:3',
                'sk' => 'required|image|file|max:2048',
                'no' => 'required|numeric|regex:/(08)[0-9]/|digits_between:10,13',
                'rek' => 'required|numeric',
                'bank' => 'required',
                'urea' => 'required|numeric',
                'za' => 'required|numeric',
                'npk' => 'required|numeric'
            ]);

            $gambar = $request->sk;
            $new_gambar = time() . ' ' . $request->cv . '.png';
            Image::make($gambar)->save('img/foto-sk/' . $new_gambar, 100, 'png');

            $distributor = new Distributor();
            $distributor->alamat = $valid['alamat'];
            if ($request->lokasi_dist) {
                $distributor->lokasi_dist = $valid['lokasi_dist'];
            }
            $distributor->cv = $valid['cv'];
            $distributor->direktur = $valid['direktur'];
            $distributor->sk = 'img/foto-sk/' . $new_gambar;
            $distributor->no = $valid['no'];
            if ($request->rek) {
                $distributor->rek = $valid['rek'];
            }
            $distributor->urea = $valid['urea'];
            $distributor->za = $valid['za'];
            $distributor->npk = $valid['npk'];
            $user->save();
            $distributor->user_id = $user->id;
            $distributor->save();

            return redirect('/')->with('Sukses', 'Akun Distributor Telah Dibuat Silahkan Login');
        }
    }
}

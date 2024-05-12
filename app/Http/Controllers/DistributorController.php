<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Distributor;
use App\Models\Pesan;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->kategori != 'Distributor') {
            if (auth()->user()->kategori == 'Petani') {
                return redirect('/petani');
            } elseif (auth()->user()->kategori == 'Pemerintah') {
                return redirect('/pemerintah');
            }
        }

        $user = User::findorfail(Auth::user()->id);
        $distributor = Distributor::where('user_id', Auth::user()->id)->first();
        $pesan = Pesan::with('petanis')->where('distributor_id', $distributor->id)->where('status', null)->orderByDesc('updated_at')->paginate(10)->withQueryString();

        // if ($user->status == 'Ditolak') {
        //     return redirect('/distributor/' . $distributor->id . '/edit');
        // }

        return view('distributor.pengajuan-pupuk')->with(compact('distributor', 'pesan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->kategori != 'Distributor') {
            if (auth()->user()->kategori == 'Petani') {
                return redirect('/petani');
            } elseif (auth()->user()->kategori == 'Pemerintah') {
                return redirect('/pemerintah');
            }
        }

        $user = User::findorfail(Auth::user()->id);

        // if ($user->status == 'Sedang Diproses') {
        //     return redirect('/distributor');
        // }

        $distributor = Distributor::findorfail($id);

        return view('distributor.edit-profil-distributor')->with(compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $distributor = Distributor::findorfail($id);

        if ($request->status) {
            $distributor->users()->update([
                'status' => $request->status
            ]);

            if ($request->ket) {
                $distributor->update([
                    'ket' => $request->status
                ]);
            }

            return back()->with('setuju', 'Akun ' . $distributor->cv . ' ' . $request->status);
        }

        $valid = $request->validate([
            'cv' => 'required|min:3',
            'direktur' => 'required|min:3',
            'sk' => 'image|file|max:2048',
            'no' => 'required|numeric|digits_between:7,16',
            'rek' => '',
            'urea' => 'required|numeric',
            'za' => 'required|numeric',
            'npk' => 'required|numeric'
        ]);

        if ($request->sk) {
            File::delete($distributor->sk);
            $gambar = $request->sk;
            $new_gambar = time() . ' ' . $request->nama . '.png';
            Image::make($gambar)->save('img/foto-sk/' . $new_gambar, 100, 'png');
            $distributor->sk = 'img/foto-sk/' . $new_gambar;
        }

        $distributor->cv = $valid['cv'];
        $distributor->direktur = $valid['direktur'];
        $distributor->no = $valid['no'];
        $distributor->rek = $valid['rek'];
        $distributor->urea = $valid['urea'];
        $distributor->za = $valid['za'];
        $distributor->npk = $valid['npk'];

        if ($distributor->ket) {
            $distributor->users()->update([
                'status' => 'Sedang Diproses'
            ]);
        }

        $distributor->ket = '';
        $distributor->save();

        return back()->with('sukses', 'Profil Telah Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        //
    }

    public function pengiriman()
    {
        if (auth()->user()->kategori != 'Distributor') {
            if (auth()->user()->kategori == 'Petani') {
                return redirect('/petani');
            } elseif (auth()->user()->kategori == 'Pemerintah') {
                return redirect('/pemerintah');
            }
        }

        $user = User::findorfail(Auth::user()->id);
        $distributor = Distributor::where('user_id', Auth::user()->id)->first();
        $pesan = Pesan::with(['petanis', 'distributors'])->where('distributor_id', $distributor->id)->where('bayar', '1')->where('selesai', '0')->orderByDesc('updated_at')->paginate(10)->withQueryString();

        // if ($user->status == 'Ditolak') {
        //     return redirect('/distributor/' . $distributor->id . '/edit');
        // } elseif ($user->status == 'Sedang Diproses') {
        //     return redirect('/distributor');
        // }

        return view('distributor.data-pengiriman')->with(compact('distributor', 'pesan'));
    }

    public function riwayat(Request $request)
    {
        $status = User::findorfail(Auth::id());
        $distributor = Distributor::where('user_id', $status->id)->first();

        // if ($status->status == 'Ditolak') {
        //     return redirect('/distributor/' . $distributor->id . '/edit');
        // } elseif ($status->status == 'Sedang Diproses') {
        //     return redirect('/distributor');
        // }

        $pesan = Pesan::with('petanis')->where('distributor_id', $distributor->id)->orderByDesc('updated_at')->distributor(request(['search']))->paginate(10)->withQueryString();
        $search = $request->search;

        return view('distributor.riwayat-pesanan-distributor')->with(compact('distributor', 'pesan', 'search'));
    }
}

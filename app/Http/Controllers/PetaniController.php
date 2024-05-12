<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Pesan;
use Image;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->kategori != 'Petani') {
            if(auth()->user()->kategori == 'Distributor'){
                return redirect('/distributor');
            }
            elseif(auth()->user()->kategori == 'Pemerintah'){
                return redirect('/pemerintah');
            }
        }

        $user = User::findorfail(Auth::user()->id);
        $petani = Petani::where('user_id', $user->id)->first();
        $distributor = Distributor::orderBy('cv')->get();

        if ($user->status == 'Ditolak') {
            return redirect('/petani/' . $petani->id . '/edit');
        }

        $pesan = Pesan::where('petani_id', $petani->id)->orderByDesc('updated_at')->first();

        if($pesan){
            if($pesan->status == 'Diterima' && $pesan->selesai == null){
                return redirect('/petani/proses');
            } elseif($pesan->status == null){
                return redirect('/petani/proses');
            }
        }

        return view('petani.pesan-pupuk')->with(compact('petani', 'pesan', 'distributor'));
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
     * @param  \App\Models\Petani  $petani
     * @return \Illuminate\Http\Response
     */
    public function show(Petani $petani)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petani  $petani
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->kategori != 'Petani') {
            if(auth()->user()->kategori == 'Distributor'){
                return redirect('/distributor');
            }
            elseif(auth()->user()->kategori == 'Pemerintah'){
                return redirect('/pemerintah');
            }
        }

        $user = User::findorfail(Auth::user()->id);

        if ($user->status == 'Sedang Diproses') {
            return redirect('/petani');
        }

        $petani = Petani::findorfail($id);

        return view('petani.edit-profil-petani')->with(compact('petani'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petani  $petani
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $petani = Petani::findorfail($id);

            if ($request->status) {
                $petani->users()->update([
                    'status' => $request->status
                ]);

                if($request->ket){
                    $petani->update([
                        'ket' => $request->ket
                    ]);
                }

                return back()->with('status', 'Akun ' . $petani->nama . ' ' . $request->status);
            }

        $valid = $request->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required|min:3',
            'nik' => 'required|numeric|digits:16',
            'no' => 'required|numeric|digits_between:7,16',
            'ktp' => 'image|file|max:2048'
        ]);

        if($request->ktp){
            File::delete($petani->ktp);
            $gambar = $request->ktp;
            $new_gambar = time().' '.$request->nama.'.png';
            Image::make($gambar)->save('img/foto-ktp/'.$new_gambar, 100, 'png');
            $petani->ktp = 'img/foto-ktp/'.$new_gambar;
        }

        $petani->nama = $valid['nama'];
        $petani->alamat = $valid['alamat'];
        $petani->nik = $valid['nik'];
        $petani->no = $valid['no'];

        if($petani->ket){
            $petani->users()->update([
                'status' => 'Sedang Diproses'
            ]);
        }

        $petani->ket = '';
        $petani->save();


        return back()->with('sukses', 'Profil Telah Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petani  $petani
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petani $petani)
    {
        //
    }

    public function proses()
    {
        $status = User::findorfail(Auth::id());
        $petani = Petani::where('user_id', $status->id)->first();

        if ($status->status == 'Ditolak') {
            return redirect('/petani/' . $petani->id . '/edit');
        } elseif ($status->status == 'Sedang Diproses') {
            return redirect('/petani');
        }

        $pesan = Pesan::with(['petanis', 'distributors'])->orderByDesc('updated_at')->where('petani_id', $petani->id)->first();

        if ($pesan->status == 'Ditolak'){
            return redirect('/petani');
        }

        return view('petani.proses')->with(compact('petani', 'pesan'));
    }

    public function profil(Request $request)
    {
        $status = User::findorfail(Auth::id());
        $petani = Petani::where('user_id', $status->id)->first();

        if ($status->status == 'Ditolak') {
            return redirect('/petani/' . $petani->id . '/edit');
        } elseif ($status->status == 'Sedang Diproses') {
            return redirect('/petani');
        }

        $distributor = Distributor::orderByDesc('updated_at')->cari(request(['search']))->paginate(10)->withQueryString();
        $search = $request->search;

        return view('petani.profil-distributor')->with(compact('petani', 'distributor', 'search'));
    }

    public function riwayat(Request $request)
    {
        $status = User::findorfail(Auth::id());
        $petani = Petani::where('user_id', $status->id)->first();

        if ($status->status == 'Ditolak') {
            return redirect('/petani/' . $petani->id . '/edit');
        } elseif ($status->status == 'Sedang Diproses') {
            return redirect('/petani');
        }

        $pesan = Pesan::with('distributors')->where('petani_id', $petani->id)->orderByDesc('updated_at')->petani(request(['search']))->paginate(10)->withQueryString();
        $search = $request->search;

        return view('petani.riwayat-pesanan-petani')->with(compact('petani', 'pesan', 'search'));
    }
}

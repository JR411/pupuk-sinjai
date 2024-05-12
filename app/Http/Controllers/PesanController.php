<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Distributor;
use Image;
use App\Models\Pesan;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'alamat' => 'required|min:3',
            'luas' => 'required|numeric',
            'lahan' => 'required|image|file|max:2048',
            // 'distributor_id' => 'required',
            'lokasi' => ''
            // 'lat' => 'required',
            // 'long' => 'required'
        ]);

        $save = new Pesan;
        $petani = Petani::where('user_id', Auth::id())->first();

        $gambar = $request->lahan;
        $new_gambar = time() . ' ' . $petani->nama . '.png';
        Image::make($gambar)->save('img/foto-lahan/' . $new_gambar, 100, 'png');

        $desa = Desa::where('id', $petani->desa_id)->first();

        $save->petani_id = $petani->id;
        $save->distributor_id = $desa->distributor_id;
        $save->alamat = $request->input('alamat');
        $save->luas = $request->input('luas');
        if ($request->lokasi) {
            $save->lokasi = $request->input('lokasi');
        }
        // $save->lat = $request->lat;
        // $save->long = $request->long;
        $save->lahan = 'img/foto-lahan/' . $new_gambar;
        $save->save();

        return redirect('/petani/proses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pesan = Pesan::findorfail($id);
        if ($request->status) {
            $pesan->update([
                'status' => $request->status
            ]);

            if ($request->ket) {
                $pesan->update([
                    'ket' => $request->ket
                ]);
            }

            return back()->with('status', 'Pengajuan Pupuk Oleh ' . $pesan->petanis->nama . ' ' . $request->status);
        } elseif ($request->bayar) {
            $pesan->update([
                'bayar' => $request->bayar
            ]);

            return back();
        } elseif ($request->kirim) {
            $pesan->update([
                'kirim' => $request->kirim
            ]);

            return back()->with('status', 'Pesanan Pupuk ' . $pesan->petanis->nama . ' Dikirim');
        } elseif ($request->selesai) {
            $pesan->update([
                'selesai' => $request->selesai
            ]);

            return back()->with('status', 'Pesanan Pupuk ' . $pesan->petanis->nama . ' Selesai');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesan $pesan)
    {
        //
    }
}

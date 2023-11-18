<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Distributor;
use App\Models\Informasi;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informasi = Informasi::orderByDesc('updated_at')->paginate(5)->withQueryString();
        $petani = Petani::where('user_id', Auth::user()->id)->first();
        $distributor = Distributor::where('user_id', Auth::user()->id)->first();
        $pemerintah = User::where('id', Auth::user()->id)->first();

        if ($pemerintah->status == 'Sedang Diproses' || $pemerintah->status == 'Ditolak') {
            if ($pemerintah->kategori == 'Petani') {
                return redirect('/petani');
            } elseif ($pemerintah->kategori == 'Distributor') {
                return redirect('/distributor');
            }
        }

        return view('informasi.index-informasi')->with(compact('informasi', 'petani', 'distributor', 'pemerintah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->kategori != 'Pemerintah') {
            return redirect('/informasi-pupuk');
        }

        $pemerintah = User::where('id', Auth::user()->id)->first();

        return view('informasi.create-informasi')->with(compact('pemerintah'));
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
            'judul' => 'required|max:255',
            'isi' => 'required|min:100',
            'gambar' => 'image|file|max:2048'
        ]);

        if ($request->gambar) {
            $gambar = $request->gambar;
            $new_gambar = time() . ' ' . $request->judul . '.png';
            Image::make($gambar)->save('img/foto-informasi/' . $new_gambar, 100, 'png');

            Informasi::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kutipan' => Str::limit($request->isi, 170),
                'gambar' => 'img/foto-informasi/' . $new_gambar
            ]);
        } else {
            Informasi::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kutipan' => Str::limit($request->isi, 170)
            ]);
        }

        return redirect('/informasi-pupuk')->with('sukses', 'Informasi Pupuk Telah Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $informasi = Informasi::where('slug', $slug)->first();
        $petani = Petani::where('user_id', Auth::user()->id)->first();
        $distributor = Distributor::where('user_id', Auth::user()->id)->first();
        $pemerintah = User::where('id', Auth::user()->id)->first();

        if ($pemerintah->status == 'Sedang Diproses' || $pemerintah->status == 'Ditolak') {
            if ($pemerintah->kategori == 'Petani') {
                return redirect('/petani');
            } elseif ($pemerintah->kategori == 'Distributor') {
                return redirect('/distributor');
            }
        }

        return view('informasi.show-informasi')->with(compact('informasi', 'petani', 'distributor', 'pemerintah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::user()->kategori != 'Pemerintah') {
            return redirect('/informasi-pupuk');
        }
        $informasi = Informasi::where('slug', $slug)->first();
        $petani = Petani::where('user_id', Auth::user()->id)->first();
        $distributor = Distributor::where('user_id', Auth::user()->id)->first();
        $pemerintah = User::where('id', Auth::user()->id)->first();

        return view('informasi.edit-informasi')->with(compact('informasi', 'petani', 'distributor', 'pemerintah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'judul' => 'required|max:255',
            'isi' => 'required|min:100',
            'gambar' => 'image|file|max:2048'
        ]);

        $informasi = Informasi::where('slug', $slug)->first();

        if ($request->has('gambar')) {
            if ($informasi->gambar) {
                File::delete($informasi->gambar);
            }
            $gambar = $request->gambar;
            $new_gambar = time() . ' ' . $request->judul . '.png';
            Image::make($gambar)->save('img/foto-informasi/' . $new_gambar, 100, 'png');

            $informasi_data = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kutipan' => Str::limit($request->isi, 170),
                'slug' => Str::slug(''),
                'gambar' => 'img/foto-informasi/' . $new_gambar
            ];
        } else {
            $informasi_data = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kutipan' => Str::limit($request->isi, 170),
                'slug' => Str::slug('')
            ];
        }

        $informasi->update($informasi_data);

        return redirect('/informasi-pupuk')->with('sukses', 'Informasi Pupuk Telah Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $informasi = Informasi::findorfail($id);

        if ($informasi->gambar) {
            File::delete($informasi->gambar);
        }

        Informasi::destroy($id);

        return redirect('/informasi-pupuk')->with('sukses', 'Informasi Pupuk Telah Dihapus');
    }
}

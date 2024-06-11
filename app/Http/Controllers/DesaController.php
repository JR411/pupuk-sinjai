<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\ValidLokasi;
use App\Models\Distributor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $desa = Desa::orderBy('nama_desa')->paginate(10)->withQueryString();
        $pemerintah = User::where('id', Auth::id())->first();
        $distributor = Distributor::orderBy('cv')->get();

        $kode = DB::table('valid_lokasis')->get();

        // $nama_desa = [];

        // foreach ($kode as $kod) {
        //     // $kodd = $kod['nama_desa'];

        //     $nama_desa = DB::table('wilayah')->where('kode', $kod['nama_desa'])->first();
        // }


        // $wilayah = DB::table('valid_lokasis')
        // ->crossJoin('wilayah', 'valid_lokasis.nama_desa', '=', 'wilayah.kode')->get();
        // ->select('valid_lokasis.', 'wilayah.')->get();
        // ->where('buka_kredits.id', '=', 'konfirs.buka_kredit_id')
        // ->where('konfirmasi', 'Terima')
        // ->whereIn('level', ['Admin Kredit', 'Kepala Bagian Bisnis']) //Cocokmi ini
        // ->where('level', 'Admin Kredit')
        // ->orWhere('level', 'Kepala Bagian Bisnis')
//         ->get();

// die(print_r($wilayah));



        return view('desa.index-desa')->with(compact('kode', 'pemerintah', 'distributor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemerintah = User::where('id', Auth::user()->id)->first();
        $distributor = Distributor::orderBy('cv')->get();

        return view('desa.create-desa')->with(compact('pemerintah', 'distributor'));
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
            'nama_desa' => 'required|max:255',
            'distributor_id' => 'required'
        ]);

        Desa::create([
            'nama_desa' => $request->nama_desa,
            'distributor_id' => $request->distributor_id
        ]);

        return redirect('/pemerintah/data-desa')->with('sukses', 'Data Desa Telah Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_desa' => 'required|max:255',
            'distributor_id' => 'required'
        ]);

        $desa = Desa::findorfail($id);

        $data_desa = [
            'nama_desa' => $request->nama_desa,
            'distributor_id' => $request->distributor_id
        ];

        $desa->update($data_desa);

        return redirect('/pemerintah/data-desa')->with('sukses', 'Data Desa Telah Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $desa = Desa::findorfail($id);

        // Desa::destroy($id);

        DB::table('valid_lokasis')->where('id', '=', $id)->delete();

        return redirect('/pemerintah/data-desa')->with('sukses', 'Desa Telah Dihapus');
    }


    public function valid_lokasi (Request $request)
    {
        $validated = $request->validate([
            // 'nama_desa' => '',
            'distributor_id' => 'required'
        ]);

        $lokasis = explode('.', $request->adadeh);

        // Output each element of the
        // resulting array
        $i = 1;
        foreach ($lokasis as $lok) {
            $lokasi[$i] = $lok;

            $i++;
        }

        $provinsi = $lokasi[1];
        $kabupaten = $lokasi[1] . '.' . $lokasi[2];
        $kecamatan = $lokasi[1] . '.' . $lokasi[2] . '.' . $lokasi[3];
        $kelurahan = $lokasi[1] . '.' . $lokasi[2] . '.' . $lokasi[3] . '.' . $lokasi[4];

        $kelurahann=implode(".",$lokasi);
        // $distributor_id=implode("",$request->distributor_id);

        // die(var_dump($request->distributor_id ));
        // die(var_dump($lokasis ));
        $store['nama_desa'] = $kelurahan;
        $store['distributor_id'] = $request->distributor_id;
        // die(var_dump($store['nama_desa'] ));
        // ValidLokasi::create($store);
        // ValidLokasi::create([
        //     'nama_desa' => $kelurahann,
        //     'distributor_id' => '3'
        //     // 'distributor_id' => $request->distributor_id
        // ]);

        DB::table('valid_lokasis')->insert([
            'nama_desa' => $kelurahan,
            'distributor_id' => $request->distributor_id
        ]);

        // $ValidLokasi = new ValidLokasi();
        // $ValidLokasi->nama_desa = $kelurahan;
        // $ValidLokasi->distributor_id = $validated['distributor_id'];

        // $ValidLokasi->save();

        return redirect('/pemerintah/data-desa')->with('sukses', 'Data Desa Telah Ditambah');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Distributor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::orderBy('nama_desa')->paginate(10)->withQueryString();
        $pemerintah = User::where('id', Auth::id())->first();
        $distributor = Distributor::orderBy('cv')->get();

        return view('desa.index-desa')->with(compact('desa', 'pemerintah', 'distributor'));
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
        $desa = Desa::findorfail($id);

        Desa::destroy($id);

        return redirect('/pemerintah/data-desa')->with('sukses', 'Desa ' . $desa->nama_desa . ' Telah Diedit');
    }
}

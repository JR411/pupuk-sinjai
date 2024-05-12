<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Pesan;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributor = User::where('kategori', 'distributor')->orderBy('username')->paginate(10)->withQueryString();
        $pemerintah = User::where('id', Auth::user()->id)->first();

        return view('pemerintah.index-akun')->with(compact('distributor', 'pemerintah'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'required|confirmed|min:3'
        ]);

        $akun = User::findorfail($id);
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->save();

        return back()->with('sukses', 'Akun ' . $akun->username . ' Telah Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);

        if ($user->kategori == 'Petani') {
            $petani = Petani::where('user_id', $user->id)->first();
            File::delete($petani->ktp);
            $pesan = Pesan::where('petani_id', $petani->id)->get();
            foreach ($pesan as $item) {
                File::delete($item->lahan);
            }
        } elseif ($user->kategori == 'Distributor') {
            // echo $user;
            $distributor = Distributor::where('user_id', $user->id)->first();
            File::delete($distributor->sk);
            $pesan = Pesan::where('distributor_id', $distributor->id)->get();
            foreach ($pesan as $item) {
                File::delete($item->lahan);
            }
        }

        User::destroy($id);

        return redirect('/pemerintah')->with('sukses', 'Akun    ' . $user->username . 'Telah Dihapus');
    }
}

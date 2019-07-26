<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Perangkat;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perangkat = DB::table('perangkats')->orderBy('nama_perangkat', 'ASC')->get();

        return view('pages.master.perangkat.index')->with('perangkat',$perangkat);
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
        if($request->action == "add") {

            $perangkat = Perangkat::create([
                'nama_perangkat'          => $request->nama
            ]);
            Session::flash('success', 'Data berhasil tersimpan.');

        } else if($request->action == "edit") {

            $perangkat = Perangkat::find($request->id);
            $perangkat->nama_perangkat        = $request->nama;
            $perangkat->save();
            Session::flash('success', 'Data berhasil diubah.');
        }



        return redirect()->route('perangkat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $perangkat = DB::table('perangkats')
            ->where('perangkat_id', $request->id)
            ->first();

        return response()->json($perangkat, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perangkat = Perangkat::find($request->id);
        $perangkat->delete();
        Session::flash('success', 'Data berhasil dihapus.');
    }
}

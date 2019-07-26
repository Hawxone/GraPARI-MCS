<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = DB::table('layanans')->orderBy('nama_layanan', 'ASC')->get();

        return view('pages.master.layanan.index')->with('layanan',$layanan);
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

            $layanan = Layanan::create([
                'nama_layanan'          => $request->nama
            ]);
            Session::flash('success', 'Data berhasil tersimpan.');

        } else if($request->action == "edit") {

            $layanan = Layanan::find($request->id);
            $layanan->nama_layanan        = $request->nama;
            $layanan->save();
            Session::flash('success', 'Data berhasil diubah.');
        }



        return redirect()->route('layanan.index');
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
        $layanan = DB::table('layanans')
            ->where('layanan_id', $request->id)
            ->first();

        return response()->json($layanan, 201);
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
        $layanan = Layanan::find($request->id);
        $layanan->delete();
        Session::flash('success', 'Data berhasil dihapus.');
    }
}

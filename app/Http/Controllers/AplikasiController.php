<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\App;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = DB::table('apps')->orderBy('nama_app', 'ASC')->get();

        return view('pages.master.app.index')->with('aplikasi',$app);
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

            $app = App::create([
                'nama_app'          => $request->nama
            ]);
            Session::flash('success', 'Data berhasil tersimpan.');

        } else if($request->action == "edit") {

            $app = App::find($request->id);
            $app->nama_app       = $request->nama;
            $app->save();
            Session::flash('success', 'Data berhasil diubah.');
        }



        return redirect()->route('app.index');
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
        $app = DB::table('apps')
            ->where('app_id', $request->id)
            ->first();

        return response()->json($app, 201);
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
        $app = App::find($request->id);
        $app->delete();
        Session::flash('success', 'Data berhasil dihapus.');
    }
}

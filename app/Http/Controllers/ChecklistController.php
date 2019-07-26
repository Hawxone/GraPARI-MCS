<?php

namespace App\Http\Controllers;

use App\Check;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;


class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = DB::table('apps')
            ->orderBy('nama_app', 'ASC')
            ->get();

        $layanan = DB::table('layanans')
            ->orderBy('nama_layanan', 'ASC')
            ->get();

        $perangkat = DB::table('perangkats')
            ->orderBy('nama_perangkat', 'ASC')
            ->get();

        $cek = Check::whereDate('created_at', Carbon::today())->get();

        $data = array();
        $data['app'] = $app;
        $data['layanan'] = $layanan;
        $data['perangkat'] = $perangkat;
        $data['cek'] = $cek;


        return view('pages.checklist.index', compact('data'));
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

            $app = Check::create([
                'status'        =>$request->status,
                'nama_checklist' =>$request->nama
            ]);

        } else if($request->action == "edit"){

            $app = DB::table('checks')
                ->where ('nama_checklist', $request->nama)
                ->whereDate('created_at', Carbon::today())
                ->update(['status' => $request->status]);



        }






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
        $app = DB::table('checks')
            ->where ('nama_checklist', $request->nama)
            ->whereDate('created_at', Carbon::today())->first();

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
    public function destroy($id)
    {
        //
    }
}

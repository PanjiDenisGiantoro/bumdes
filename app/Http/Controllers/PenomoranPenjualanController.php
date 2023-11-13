<?php

namespace App\Http\Controllers;

use App\Models\PenomoranPenjualan;
use Illuminate\Http\Request;

class PenomoranPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tetapan.penomoran_penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tetapan.penomoran_penjualan.form');

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
     * @param  \App\Models\PenomoranPenjualan  $penomoranPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(PenomoranPenjualan $penomoranPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenomoranPenjualan  $penomoranPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(PenomoranPenjualan $penomoranPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenomoranPenjualan  $penomoranPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenomoranPenjualan $penomoranPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenomoranPenjualan  $penomoranPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenomoranPenjualan $penomoranPenjualan)
    {
        //
    }
}

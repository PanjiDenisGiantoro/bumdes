<?php

namespace App\Http\Controllers;

use App\Models\PenjualanPerSalesPerson;
use Illuminate\Http\Request;

class PenjualanPerSalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.penjualan_per_sales_person.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.penjualan_per_sales_person.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PenjualanPerSalesPerson::create($request->all());

        return \redirect()
            ->route("semua_laporan.penjualan_per_sales_person.index")
            ->with("success", __("Pengajuan Penjualan Per Sales Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PenjualanPerSalesPerson $penjualan_per_sales_person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PenjualanPerSalesPerson $penjualan_per_sales_person)
    {
        return view("penjualan_per_sales_person.form", \compact("penjualan_per_sales_person"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenjualanPerSalesPerson $penjualan_per_sales_person)
    {
        $penjualan_per_sales_person->fill($request->all());

        $penjualan_per_sales_person->save();

        return redirect()
            ->route("penjualan_per_sales_person.index")
            ->with("success", __("Perbaharui Penjualan Per Sales Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenjualanPerSalesPerson $penjualan_per_sales_person)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\pengajuan\Margin;
use Illuminate\Http\Request;
use function redirect;

class MarginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rasio = Margin::find($request->id);
        $rasio->margin = $request->margin;
        $rasio->save();

        return redirect()->route('setting_rasio.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengajuan\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function show(Margin $margin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengajuan\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function edit(Margin $margin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengajuan\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Margin $margin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengajuan\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Margin $margin)
    {
        //
    }
}

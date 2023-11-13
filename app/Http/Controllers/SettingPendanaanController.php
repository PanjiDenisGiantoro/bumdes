<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\SettingBatch;
use App\Models\SumberPendanaan;
use App\Models\SummaryBatch;
use App\Models\TemplateEmail;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;

class SettingPendanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * TODO: NOTE: SettingBatch == SettingPendanaan. Don't get confused - Arrave 
     * consider to rename the model and every related relation
     * 
     */
    public function index()
    {
        // $batch = SettingBatch::with('sumber_pendanaans')->orderBy('created_at', 'DESC')->paginate(10);
        $ListPendana = SettingBatch::orderBy('created_at', 'DESC')->get();
        // dd($ListPendana[0]->coa->kode);
        return view("setting-pendanaan.index",compact('ListPendana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $GLList = AkunPerkiraan::all();
        $sumber = SumberPendanaan::all();
        return view("setting-pendanaan.form",compact('sumber','GLList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'summary_batch' => 'required|unique:setting-pendanaans|max:255',
        // ]);
        SettingBatch::create($request->all());

        return \redirect()
            ->route("setting-pendanaan.index")
            ->with("message",("Setting Pendanaan Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendana = SettingBatch::where('id', '=', $id)->first();
        $viewMode = true;

        return view("setting-pendanaan.form",compact('pendana', 'viewMode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $GLList = AkunPerkiraan::all();
        $sumber = SumberPendanaan::all();
        $pendana = SettingBatch::where('id', $id)->first();
        return view("setting-pendanaan.form", \compact('GLList',"pendana",'sumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $batch = SettingBatch::find($id);

        $batch->fill($request->all());

        $batch->save();

        return redirect()
            ->route("setting-pendanaan.index")
            ->with("message",(" Batch Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $batch = SettingBatch::where('id',$id);
        $batch->delete();

        return redirect()
            ->route("setting-pendanaan.index")
            ->with("message",(" Batch Berhasil Terhapus"));

    }
}

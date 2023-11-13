<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::orderBy('nama_bank', 'DESC')->paginate(10);
        return view("tetapan.bank.index",compact('bank'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.bank.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|unique:banks|max:255',
            'sandi_bank' => 'required|unique:banks|max:255',
        ]);
        Bank::create($request->all());
        return \redirect()
            ->route("bank.index")
            ->with("message", ("  Bank Berhasil Terdaftar"));

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
    public function edit($id)
    {
        $bank = Bank::where('id',$id)->first();

        return view("tetapan.bank.form", \compact("bank"));

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
        $akad = Bank::find($id);
        $akad->fill($request->all());
        $akad->save();
        return redirect()
            ->route("bank.index")
            ->with("message",(" Bank Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::where('id',$id);
        $bank->delete();
        return redirect()
            ->route("bank.index")
            ->with("message",(" Bank Berhasil Terhapus"));


    }
}

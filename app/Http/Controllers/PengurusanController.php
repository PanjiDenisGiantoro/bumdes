<?php

namespace App\Http\Controllers;

use App\Models\Pengurusan;
use Illuminate\Http\Request;


class PengurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurusan = Pengurusan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.pengurusan.index",compact('pengurusan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.pengurusan.form");
        
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
            'jabatan' => 'required|unique:pengurusans|max:255',
        ]);
        Pengurusan::create($request->all());

        return \redirect()
            ->route("pengurusan.index")
            ->with("message",(" Pengurusan Berhasil Terdaftar"));
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurusan  $pengurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurusan $pengurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurusan  $pengurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurusan = Pengurusan::where('id',$id)->first();
        return view("tetapan.pengurusan.form", \compact("pengurusan"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurusan  $pengurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengurusan = Pengurusan::find($id);

        $pengurusan->fill($request->all());

        $pengurusan->save();

        return redirect()
            ->route("pengurusan.index")
            ->with("message",(" Pengurusan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurusan  $pengurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $bidangusaha = Pengurusan::where('id',$id);
        $bidangusaha->delete();

        return redirect()
            ->route("pengurusan.index")
            ->with("message",(" Pengurusan Berhasil Terhapus"));


    }
}

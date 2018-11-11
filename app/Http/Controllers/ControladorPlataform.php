<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plataform;

class ControladorPlataform extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plata = Plataform::all();
        return view('plataform', compact('plata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newPlata');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plata = new Plataform();
        $plata->name = $request->input('namePlataform');
        $plata->save();
        return redirect('/plataform');
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
      $plata = Plataform::find( $id );
        if ( isset( $plata ) ) {
          return view( '/editPlata', compact( 'plata' ) );
      }
      return redirect('/plataform');
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
      $plata = Plataform::find( $id );
      if ( isset( $plata ) ) {
          $plata->name = $request->input('namePlataform');
          $plata->save();
      }
      return redirect('/plataform');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plata = Plataform::find( $id );
        if (isset($plata)) {
          $plata->delete();
        }
        return redirect('/plataform');
    }

    public function indexJson()
    {
        $plata = Plataform::all();
        return json_encode( $plata );
    }

}

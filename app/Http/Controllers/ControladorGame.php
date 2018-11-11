<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class ControladorGame extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexView()
     {
         return view('games');
     }

     public function index()
     {
         $game = Game::all();
         return $game->toJson();
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $game = new Game();
        $game->pwd = $request->input('pwd');
        $game->name = $request->input('name');
        $game->online = $request->input('online');
        $game->time = $request->input('time');
        $game->indication = $request->input('indication');
        $game->comments = $request->input('comments');
        $game->plataform_id = $request->input('plataform_id');
        $game->save();
        return json_encode($game);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
      $game = Game::find( $id );
      if ( isset( $game ) ) {
        return json_encode( $game );
      }
      return response( 'Produto nao encontrado', 404 );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $game = Game::find( $id );
        if ( isset( $game ) ) {
          $game ->pwd = $request ->input( 'pwd' );
          $game ->name = $request ->input( 'name' );
          $game ->online = $request ->input( 'online' );
          $game ->time = $request ->input( 'time' );
          $game ->indication = $request ->input( 'indication' );
          $game ->comments = $request ->input( 'comments' );
          $game ->plataform_id = $request ->input( 'plataform_id' );
          $game ->save();
          return json_encode( $game );

        }
        return response( 'Produto nao encontrado', 404 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
      $game = Game::find( $id );
      if ( isset( $game) ) {
        $game ->delete();
      }    }
}

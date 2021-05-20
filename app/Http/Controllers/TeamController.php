<?php

namespace App\Http\Controllers;

use App\Team;
use App\Player;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Team::all());
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
        $team = new Team;
        $team->name = $request->team_name;
        $team->save();

        // teammate 1
        $player = new Player;
        $player->team_id = $team->id;
        $player->discord_name = $request->teamMate1DSC;
        $player->tarkov_name = $request->teamMate1BSG;
        $player->class = $request->teamMate1Class;
        $player->save();
        // teammate 2
        $player = new Player;
        $player->team_id = $team->id;
        $player->discord_name = $request->teamMate2DSC;
        $player->tarkov_name = $request->teamMate2BSG;
        $player->class = $request->teamMate2Class;
        $player->save();
        // teammate 3
        $player = new Player;
        $player->team_id = $team->id;
        $player->discord_name = $request->teamMate3DSC;
        $player->tarkov_name = $request->teamMate3BSG;
        $player->class = $request->teamMate3Class;
        $player->save();
        return response()->json($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}

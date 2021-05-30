<?php

namespace App\Http\Controllers;

use App\Raid;
use Illuminate\Http\Request;
use Auth;

class RaidController extends Controller
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
        $raid = new Raid;
        $raid->team_id = $request->team;
        $score = 0;
        $score += $request->kills;
        $score += $request->dogtags;
        if ($request->helmet == true) {
            $score += 1;
        }
        $score += $request->gpus;
        $score += $request->tetris;
        $score += $request->labskey;
        $score += $request->waterfilter;
        $score += $request->ledx * 2;
        $score += $request->moonshine * 2;
        $raid->points = $score;
        $raid->kills = $request->kills;
        $raid->dogtags = $request->dogtags;
        $raid->gpu = $request->gpus;
        $raid->tetris = $request->tetris;
        $raid->labskey = $request->labskey;
        $raid->waterfilter = $request->waterfilter;
        $raid->moonshine = $request->moonshine;
        $raid->ledx = $request->ledx;
        $raid->helmet = $request->helmet;
        $raid->created_by = Auth::user()->id;
        $raid->save();
        return response()->json($raid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function show(Raid $raid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function edit(Raid $raid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raid $raid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raid  $raid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raid $raid)
    {
        //
    }
}

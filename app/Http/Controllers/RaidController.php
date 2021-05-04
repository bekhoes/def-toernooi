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
        if ($request->bosskill == true) {
            $score += 2;
        }
        $score += $request->gpus * 2;
        $score += $request->ledx * 2;
        $raid->points = $score;
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

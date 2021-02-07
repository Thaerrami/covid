<?php

namespace App\Http\Controllers;

use App\Casenum;
use Illuminate\Http\Request;

class CasenumController extends Controller
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

    public function chart(){
        //->groupBy('status')
        $result = Casenum::select(['daycase','recover','death','date'])->get();
        return response()->json($result);
    }

    public function chart2(){
        //->groupBy('status')
        $result = Casenum::select(['norcase','midcase','dancase','date'])->get();
        return response()->json($result);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Casenum  $casenum
     * @return \Illuminate\Http\Response
     */
    public function show(Casenum $casenum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Casenum  $casenum
     * @return \Illuminate\Http\Response
     */
    public function edit(Casenum $casenum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Casenum  $casenum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casenum $casenum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Casenum  $casenum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Casenum $casenum)
    {
        //
    }
}

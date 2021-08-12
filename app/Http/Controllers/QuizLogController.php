<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\QuizLog;
use Exception;
use Illuminate\Http\Request;

class QuizLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response(QuizLog::all(),200);
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
     * @param  \App\Models\QuizLog  $quizLog
     * @return \Illuminate\Http\Response
     */
    public function show(QuizLog $quizLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizLog  $quizLog
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizLog $quizLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizLog  $quizLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizLog $quizLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizLog  $quizLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizLog $quizLog)
    {
        //
    }
    
}

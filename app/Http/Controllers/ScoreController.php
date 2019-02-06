<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ScoreRepository;

class ScoreController extends Controller
{
    protected $score;

    public function __construct()
    {
        $this->score = new ScoreRepository();
    }

    public function Score(Request $request)
    {
        $data = $request->except('_token');
        $scores = $this->score->getData($data['username']);
        return view('welcome')->with($scores);
    }
}

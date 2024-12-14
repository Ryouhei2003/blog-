<?php

namespace App\Http\Controllers;

use App\Models\Visit;

class VisitController extends Controller
{
    public function index()
    {
        // 訪問データを取得または作成
        $visit = Visit::firstOrCreate([], ['count' => 0]);

        // カウントを増やす
        $visit->increment('count');

        // 訪問回数をビューに渡す
        return view('index', ['count' => $visit->count]);
    }
}

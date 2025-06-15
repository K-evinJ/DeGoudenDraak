<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu');
    }

    public function news()
    {
        $news = News::orderBy('date', 'desc')->value('text');
        return view('news', ['news' => $news]);
    }

    public function sales()
    {
        return view('sales');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\News;
use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;
use Spatie\LaravelPdf\Enums\Format;

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

    public function contact()
    {
        return view('contact');
    }

    public function downloadMenu()
    {
        $dishTypes = Dish::where('visible', 1)->orderBy('number', 'asc')->get()->groupby('dish_type');
        // dd($dishTypes);
        return pdf('menu-pdf', ['dishTypes' => $dishTypes])->landscape();
    }
}

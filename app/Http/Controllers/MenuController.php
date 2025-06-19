<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Discount;
use Spatie\LaravelPdf\Facades\Pdf;

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

    public function dishes(Request $request)
    {
        $favoriteSort = $request->favoriteSort ?? 'number';
        $favoriteOrder = $request->favoriteOrder ?? 'asc';
        $normalSort = $request->normalSort ?? 'number';
        $normalOrder = $request->normalOrder ?? 'asc';

        $options = [
            'favoriteSort' => $favoriteSort,
            'favoriteOrder' => $favoriteOrder,
            'normalSort' => $normalSort,
            'normalOrder' => $normalOrder,
        ];

        $favoriteIds = session('favorites', []);
        $favorites = Dish::where('visible', 1)
            ->whereIn('id', $favoriteIds)
            ->orderby($favoriteSort, $favoriteOrder)
            ->get()
            ->groupby('dish_type');
        $nonFavorites = Dish::where('visible', 1)
            ->whereNotIn('id', $favoriteIds)
            ->orderby($normalSort, $normalOrder)
            ->get()
            ->groupby('dish_type');
        return view('dishes', ['favorites' => $favorites, 'nonFavorites' => $nonFavorites, 'options' => $options]);
    }

    public function favorite(Request $request)
    {
        $request->validate([
            'dish' => ['required'],
        ]);

        $dishes = session('favorites');
        $dishes[] = $request->dish;
        session(['favorites' => $dishes]);

        return redirect()->route('dishes');
    }

    public function unfavorite(Request $request)
    {
        $request->validate([
            'dish' => ['required'],
        ]);

        $dishId = $request->input('dish');

        $favorites = session('favorites');
        $favorites = array_filter($favorites, fn($id) => $id != $dishId);
        session(['favorites' => $favorites]);

        return redirect()->route('dishes');
    }
        
    public function downloadMenu()
    {
        $dishTypes = Dish::where('visible', 1)->orderBy('number', 'asc')->get()->groupby('dish_type');
        $discounts = Discount::where('end_date', '>', Carbon::now())->with('dish')->get();
        return Pdf::view('menu-pdf', ['dishTypes' => $dishTypes, 'discounts' => $discounts])->landscape()->download('menukaart.pdf');
    }
}

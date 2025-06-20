<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderby('created_at', 'desc')->get();
        return view('review', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => ['required'],
            'comment' => ['required'],
        ], 
        [
            'rating.required' => 'Het aantal sterren is verplicht.',
            'comment.required' => 'Een commentaar is verplicht.',
        ]);

        Review::create([
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Review succesvol gepubliceerd.');
    }
}

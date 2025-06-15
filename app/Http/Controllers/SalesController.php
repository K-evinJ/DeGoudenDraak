<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Carbon;

class SalesController
{
    public function index(){
        return view('EmployeeViews.saleOverview',['orders' => [], 'vat' => 0.00,
            'total' => 0.00]);
    }

    public function getOrders(Request $request){
        $validated = $request->validate([
            'BeginDate' => 'required',
            'EndDate' => 'required',
        ]);
        if($validated['BeginDate'] > $validated['EndDate']){ return redirect()->route('saleOverview')->with('order_message', 'einddatum moet voor begindatum liggen');}

        $end = Carbon::parse($validated['EndDate'])->addDay();
        $begin = Carbon::parse($validated['BeginDate']);
        $orders = Order::with('dishes')
        ->whereBetween('moment', [$begin, $end])
        ->where('is_paid',true)
        ->get();

        $total = 0;
        foreach ($orders as $order) {
            foreach ($order->dishes as $dish) {
                $subtotal = $dish->pivot->amount * $dish->pivot->original_dishprice;
                $total += $subtotal;
            }
        }
        $vat = round($total * 0.09,2);
        return view('EmployeeViews.saleOverview', [
            'orders' => $orders,
            'vat' => $vat,
            'total' => $total,
        ]);
    }
}
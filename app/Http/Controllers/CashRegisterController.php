<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CashRegisterController
{
    public function index(){
        $dishes = Dish::where('visible', true)->get();
        $groupedDishes = $dishes->groupBy('dish_type')->filter()->sortKeys();
        return view('EmployeeViews.CashRegister', compact('groupedDishes'));
    }
    
    public function store(Request $request)
    {
        $decoded = json_decode($request->input('dishes'), true);

        $validated = ['dishes' => $decoded];

        $order = Order::create([
            'is_paid' => true,
            'is_delivered' => false,
            'moment' => Carbon::now(),
        ]);

        $attachData = [];

        foreach ($validated['dishes'] as $dishId => $quantity) {
            if ($quantity > 0) {
                $dish = Dish::findOrFail($dishId);

                $attachData[$dishId] = [
                    'amount' => $quantity,
                    'original_dishprice' => $dish->current_price,
                    'extra_information' => null,
                ];
            }
        }

        if (count($attachData) === 0) {
            return redirect()->route('employee.cashRegister')->with('order_message', 'Niets geselecteerd');
        }

        $order->dishes()->attach($attachData);

        session()->flash('download_receipt_order_id', $order->id);
        
        return redirect()->route('employee.cashRegister')->with('order_message', 'Verkoop succesvol!');
    }

    public function downloadReceipt(Order $order)
    {
        $qr = base64_encode(QrCode::size(50)->generate(route('review')));
        $pdf = Pdf::loadView('employeeViews.receipt', compact(['order', 'qr']))
        ->setPaper([0, 0, 240, 283], 'portrait');

        return $pdf->download("Rekening_Order_{$order->id}.pdf");
    }
}
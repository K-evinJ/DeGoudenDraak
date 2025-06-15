<?php

namespace App\Http\Controllers;


class SalesController
{
    public function index(){
        return view('EmployeeViews.saleOverview');
    }
}
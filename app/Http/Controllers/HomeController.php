<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Sales;
use App\models\Purchase;
use App\models\Stock;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = Sales::count();
        $purchase = Purchase::count();
        $stock = Stock::with('category','salesdetail', 'purchasedetail')
                        ->orderBy('id', 'asc')
                        ->get()
                        ->take(10);
        foreach ($stock as $key => $value) {
            $value->stock = $value->initial - $value->salesdetail->sum('qty');
            $value->stock = $value->stock + $value->purchasedetail->sum('qty');
            $value->stock = $value->stock;
        }
        return view('pages.dashboards', compact('sales', 'purchase', 'stock'));
    }
}

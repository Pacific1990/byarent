<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\House;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
        $total = array(
            'users' => count(User::all()),
            'houses' => count(House::all()),
            'orders' => count(Order::all())
        );

        $values = Order::where('user_id', Auth::user()->id)->get();

        return view('dashboard/home', compact('total', 'values'));
    }

    /**
     *
     */
    public function order(Order $order)
    {
        foreach (session('cart') as $id => $details) {
            $order->house_id = $id;
            $order->user_id = Auth::user()->id;
            $order->date = date('Y-m-d');
            $order->time = date('H:i:s');
            $order->quantity = $details['quantity'];
            $order->created_by = Auth::user()->id;
            $order->updated_by = Auth::user()->id;
            $order->save();
        }
        session()->forget('cart');
        return redirect('home')->withOk("Opération effectuée avec success");
    }
}
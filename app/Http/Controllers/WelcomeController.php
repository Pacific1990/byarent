<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\House;

/**
 * Class WelcomeController
 * @package App\Http\Controllers
 */
class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $values = House::all();
        return view('welcome/welcome', compact('values'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $value = House::find($id);
        if (!$value) {
            abort(404);
        }
        return view('welcome/detail', compact('value'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rent()
    {
        $values = House::where('rent', 1)->get();
        return view('welcome/rent', compact('values'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sale()
    {
        $values = House::where('rent', 0)->get();
        return view('welcome/sale', compact('values'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('welcome/contact');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favorite()
    {
        $values = House::all();
        return view('welcome/favorite', compact('values'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        if(! session()->get('cart')) {
            return redirect()->back()->with('success', 'Please select an item!');
        } else {
            return view('welcome/cart');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert_cart($id)
    {
        $product = House::find($id);
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->picture
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'House added to cart successfully!');
        }
        // if cart not empty then check if this house exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'House added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->picture
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'House added to cart successfully!');
    }

    /**
     * @param Request $request
     */
    public function update_cart(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * @param Request $request
     */
    public function remove_cart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        session()->flash('success', 'House removed successfully');

        if(session('cart')) {
            return redirect()->back()->with('success', 'House added to cart successfully!');
        } else {
            return redirect('/')->with('success', 'Cart empty successfully!');
        }
    }

    /**
     * @param Request $request
     */
    public function empty_cart()
    {
        session()->forget('cart');
        session()->flash('success', 'House removed successfully');
        return redirect('/')->with('success', 'Cart empty successfully!');
    }

}

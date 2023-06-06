<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{

    // protect all routes
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // $pizzas = [
        //     ['type' => 'hawaiian', 'base' => 'cheesy crust'],
        //     ['type' => 'volcano', 'base' => 'garlic crust'],
        //     ['type' => 'veg supreme', 'base' => 'thin & crispy'],
        // ];

        //1 way
        // $pizzas = Pizza::all();

        //2 way
        //$pizzas = Pizza::orderBy('name', 'desc')->get();
        //$pizzas = Pizza::where('type', 'hawaiian')->get();
        $pizzas = Pizza::latest()->get();

        return view('pizzas.index', [
            'pizzas' => $pizzas
        ]);
    }



    public function show($id)
     {
        $pizza = Pizza::findOrFail($id);
        return view('pizzas.show', ['pizza' => $pizza]);
    }


    public function create(){
        return view('pizzas.create');
    }
    

    public function store() {
        // error_log(request('name'));
        // error_log(request('type'));
        // error_log(request('base'));
        // error_log(request('amount'));

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');
        $pizza->amount = request('amount');

        $pizza->save();


        return redirect('/')->with('msg', "Thanks for your order");
    }

    public function destroy($id){
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return redirect('/pizzas');
    }
}

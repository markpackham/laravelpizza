<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index() {

      // $pizzas = Pizza::all();
      // $pizzas = Pizza::orderBy('name', 'desc')->get();
      // $pizzas = Pizza::where('type','hawiian')->get();
      $pizzas = Pizza::latest()->get();

        return view('pizzas.index', [
          'pizzas' => $pizzas,
        ]);
      }
    
      public function show($id) {
        // use the $id variable to query the db for a record
        $pizza = Pizza::find($id);
        return view('pizzas.show', ['pizza' => $pizza]);
      }

      public function create(){
        return view('pizzas.create');
      }

      public function store(Request $request){

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');
    
        $pizza->save();
    
        return redirect('/')->with('mssg', 'Thanks for your order!');
      }

      public function destory($id) {
        $pizza = $pizza = Pizza::findOrFail($id);
        $pizza->delete();
        return redirect('/')->with('mssg', 'Order completed/deleted!');
      }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'fecha_na' => 'required|date',
            'ci' => 'required|integer',
            'correo' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'telefono' => 'required|string|max:12',
            'carrera' => 'required|string|max:25',
            'semestre' => 'required|string|max:25',
            'notas' => 'required',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'El producto fue creado correctamente');
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'El producto se modificado correctamente');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('success', 'El producto fue eliminado correctamente');
    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }
}

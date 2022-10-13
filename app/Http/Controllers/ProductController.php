<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return response()->json([
            'message' => 'success',
            'info' => 'Productos disponibles',
            'product' =>$product,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->code = $request->code;
        $product->name_product = $request->name_product;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json([
            'message' => 'success',
            'info' => 'Producto registrado correctamente',
            'product' =>$product,   
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product =  Product::find($id);
        $product->code = $request->code;
        $product->name_product = $request->name_product;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json([
            'message' => 'success',
            'info' => 'Producto editado correctamente',
            'product' =>$product,   
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

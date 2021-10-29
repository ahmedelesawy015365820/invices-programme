<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Section;
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
        $sections = Section::all();
        $Products = Product::with(["section" => function($q){

            return $q->select("section_name","id");

        }])->get();

        // return $Products;

        return view("product.products",compact("sections","Products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            "product_name" => $request->product_name,
            "dscription" => $request->dscription,
            "section_id" =>  $request->section_id
        ]);

        return redirect()->back()->with(["success" => " تمت الاضافه بنجاح"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {

        $id_pro = Section::where("section_name",$request->section_name)->first()->id;

        $id = Product::find($request->id);

        if(!$id)
            return redirect()->back()->with(["error" => "هذا القسم غير موجود"]);

        $id->update([
            "product_name" => $request->product_name,
            "dscription" => $request->dscription,
            "section_id" =>  $id_pro
        ]);

        return redirect()->back()->with(["success" => "تم التعديل بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

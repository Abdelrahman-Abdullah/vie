<?php

namespace App\Http\Controllers;

use App\Http\Resources\API\ProductResource;
use App\Models\Products;
use App\Traits\Responses;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use Responses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return self::success('Products retrieved successfully', [
            'products' => ProductResource::collection(Products::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}

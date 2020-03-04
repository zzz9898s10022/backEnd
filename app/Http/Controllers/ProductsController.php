<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $all_products = Products::all();

        return view('admin/products/index', compact('all_products'));
    }

    public function create()
    {
        return view('admin/products/create');
    }

    public function store(Request $request)
    {
        $products_data = $request->all();
        Products::create($products_data)->save();
        return redirect('/home/products');
    }


    public function edit($id)
    {
        $products = Products::find($id);
        return view('admin/products/edit', compact('products'));
    }
    public function update(Request $request, $id)
    {
        Products::find($id)->update($request->all());
        return redirect('/home/products');
    }


    public function delete(Request $request,$id)
    {
        Products::find($id)->delete();
        return redirect('/home/products');
    }
}

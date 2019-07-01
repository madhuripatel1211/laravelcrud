<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(5);
        return view('product.index',compact('product'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {

        $categorys = Category::orderby('id', 'desc')->get();
        return view('product.create',compact('categorys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product',
            'category_id' => 'required',
            'amount' => 'required',
        ], [

            'name.required' => 'Product Name is required',
            'name.unique' => 'Product Name must be unique',
            'category_id.required' => 'Category is required'

        ]);

        Product::create($request->all());
          //return response()->json('Product Added Successfully.');
        return redirect()->route('product.index')->with('success','Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }


    public function edit(Product $product)
    {
       
         $categorys = Category::orderby('id', 'desc')->get();
        return view('product.edit',compact('product','categorys'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',  Rule::unique('product', 'name')->ignore($id),
            'category_id' => 'required',
            'amount' => 'required',
        ], [

            'name.required' => 'Product Name is required',
            'name.unique' => 'Product Name must be unique',
            'category_id.required' => 'Category is required'

        ]);
       
        $product = Product::findOrFail($id);
 
        $product->name = request('name');
        $product->category_id = request('category_id');
        $product->amount =request('amount');
        $product->description = request('description');
        $product->save();
        return redirect()->route('product.index')->with('success','Product updated successfully.');
    }


    public function destroy($id)
    {

        Product::findOrFail($id)->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully.');
    }
}

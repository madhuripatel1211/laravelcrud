<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Product;

use Validator;


class ProductController extends BaseController

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($catid="")
    {
        $products = Product::all();
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
    }

    /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [

            'name' => 'required|unique:product',
            'category_id' => 'required',
            'amount' => 'required',

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $product = Product::create($input);


        return $this->sendResponse($product->toArray(), 'Product created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $product = Product::find($id);


        if (is_null($product)) {

            return $this->sendError('Product not found.');

        }


        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {

        $input = $request->all();


        $validator = Validator::make($input, [

            'name' => 'required', Rule::unique('product', 'name')->ignore($product->id),
            'category_id' => 'required',
            'amount' => 'required',

        ],[

            'name.required' => 'Product Name is required',
            'name.unique' => 'Product Name must be unique',
            'category_id.required' => 'Category is required'

        ]);
       
        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }
        $product->name = $input['name'];
        $product->category_id =$input['category_id'];
        $product->amount =$input['amount'];
        $product->description = $input['description'];
        $product->save();
        return $this->sendResponse($product->toArray(), 'Product updated successfully.');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();


        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');

    }

}
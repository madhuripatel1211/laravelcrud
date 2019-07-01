<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::latest()->paginate(5);
        return view('category.index',compact('categorys'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {

        $categorys = Category::orderby('id', 'desc')->get();
        return view('category.create',compact('categorys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
            'parent_id' => 'required',
        ]);

        Category::create($request->all());
          //return response()->json('Category Added Successfully.');
        return redirect()->route('category.index')->with('success','Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    }


    public function edit(Category $category)
    {
       
        $categorys = Category::where('id','!=', [$category->id])->orderby('id', 'desc')->get();
         //dd($categorys);
        return view('category.edit',compact('category','categorys'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]);
        $category = Category::findOrFail($id);
 
        $category->name = request('name');
        $category->parent_id = request('parent_id');
        $category->save();
        return redirect()->route('category.index')->with('success','Category updated successfully.');
    }


    public function destroy($id)
    {

        Category::findOrFail($id)->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully.');
    }
}

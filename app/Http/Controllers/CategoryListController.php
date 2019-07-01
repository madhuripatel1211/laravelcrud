<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CategoryListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categorys = Category::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        
        foreach ($Categorys as $Category) {
            
             $tree .='<li class="tree-view closed"><a class="tree-name" href="/productlist/'.$Category->id.'">'.$Category->name.'</a>';
             if(count($Category->childs)) {
                $tree .=$this->childView($Category);
            }
        }
        $tree .='<ul>';
        // return $tree;
        return view('categorylist',compact('tree'));
       
    }
        public function childView($Category){                 
            $html ='<ul>';
        foreach ($Category->childs as $arr) {
            if(count($arr->childs)){
            $html .='<li class="tree-view closed"><a class="tree-name"  href="/productlist/'.$arr->id.'">'.$arr->name.'</a>';                  
                    $html.= $this->childView($arr);
                }else{
                    $html .='<li class="tree-view"><a class="tree-name"  href="/productlist/'.$arr->id.'">'.$arr->name.'</a>';                                 
                    $html .="</li>";
                }
                               
        }
        
        $html .="</ul>";
        return $html;
    }
    public function productlist($catid){       
        $category = DB::table('category')->where('id', $catid)->get()->toArray();
        $product = DB::table('product')->where('category_id',$catid)->get();          
        return view('productlist',compact('product','category'));
        
    }    
}

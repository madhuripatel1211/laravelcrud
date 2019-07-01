@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Show Category</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $category->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Parent Category:</strong>
                <?php
                        $tmp="Root";
                        if($category->parent_id!=0){
                            $tmp = \App\Category::find($category->parent_id);
                            $tmp =  $tmp->name ;

                        }
                ?>
                {{ $tmp }}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Ecommerce Admin</h2>
        </div>
        <div class="col-lg-6 text-left" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('category.create') }}"> Add Category</a>
        </div>
        <div class="col-lg-6 text-right" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('home') }}">Dashboard</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if(sizeof($categorys) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Parent Category Name</th>
                <th width="280px">More</th>
            </tr>
            @foreach ($categorys as $cat)
          
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $cat->name }}</td>
                    <?php
                        $tmp="Root";
                        if(isset($cat->parent_id) && $cat->parent_id!=0){
                            $tmp = \App\Category::find($cat->parent_id);
                            if(!empty($tmp)){
                                $tmp =  $tmp->name ;
                            }

                        }
                    ?>
                    <td>{{ $tmp }}</td>
                    <td>
                        <form action="/category/destroy/{{ $cat->id }}" method="POST">

                            <a class="btn btn-info" href="{{ route('category.show',$cat->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('category.edit',$cat->id) }}">Edit</a>
                      

                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-alert">Start Adding to the Database.</div>
    @endif

    {{ $categorys->links() }}

@endsection
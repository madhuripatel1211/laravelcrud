@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Ecommerce Admin</h2>
        </div>
        <div class="col-lg-6 text-left" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('product.create') }}"> Add Product</a>
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

    @if(sizeof($product) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Catgory</th>
                <th>Price</th>
                <th width="280px">More</th>
            </tr>
            @foreach ($product as $pro)
          
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $pro->name }}</td>
                    
                    <?php
                        $tmp="Root";
                        if(isset($pro->category_id) && $pro->category_id!=0){
                            $tmp = \App\Category::find($pro->category_id);
                            if(!empty($tmp)){
                                $tmp =  $tmp->name ;
                            }

                        }
                    ?>
                    <td>{{ $tmp }}</td>
                    <td>{{ $pro->amount }}</td>  
                    <td>
                        <form action="/product/destroy/{{ $pro->id }}" method="POST">

                            <a class="btn btn-info" href="{{ route('product.show',$pro->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('product.edit',$pro->id) }}">Edit</a>
                      

                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-alert">Start Adding to the Database.</div>
    @endif

    {{ $product->links() }}

@endsection
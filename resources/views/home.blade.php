@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="top-right links">
                        
                        <a href="{{ route('category.index') }}">Category</a>
                        <a href="{{ route('product.index') }}">Product</a>
                
                </div>
            <div class="flex-center position-ref full-height">
               
                <div class="panel-heading">Dashboard</div>
             
           
                   
           
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

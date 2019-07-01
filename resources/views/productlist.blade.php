<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>    
    <div class="container">
    <div class="card">
        
        <div class="row">
            <div class="card-body">

            
                <div class="col-md-12">
                    <div class="col-lg-12 text-left" style="margin-top:10px;margin-bottom: 10px;">
                    <div class=" text-left"> Category Name: {{ $category[0]->name }}</div>
           
                    <div class="text-right"><a class="btn btn-primary" href="/"> Back</a></div>
                    </div>
                
                    <div class="row">
                    @if(sizeof($product) > 0)
                        @foreach($product as $pro)
                        <div class="col-md-4">
                            <h4>{{ $pro->name }}</h4>
                            <hr />
                            <b>Amount:</b>{{ $pro->amount }}<br /><br />
                            <b>Description:</b> {{ $pro->description }}
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-alert">No Products for this Category</div>
                    @endif
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
    </body>
</html>

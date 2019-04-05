@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as admin!
                </div>

                	<div class="container-fluid main-container">
                          <div class="col-md-2 sidebar">
                              <div class="row">
                    <!-- uncomment code for absolute positioning tweek see top comment in css -->
                    <div class="absolute-wrapper"> </div>
                    <!-- Menu -->
                    <div class="side-menu">
                        <nav class="navbar navbar-default" role="navigation">
                            <!-- Main Menu -->
                            <div class="side-menu-container">
                                <ul class="nav navbar-nav">
                                    <li id="dashboardBtn" class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                                    <li id="addProductBtn"><a href="#" ><span class="glyphicon glyphicon-plane" ></span> Add Product</a></li>
                                    <li id="myProductsBtn"><a href="#"><span class="glyphicon glyphicon-cloud"></span> My Products</a></li>
                
                                    <!-- Dropdown-->
                                   
                
                                    <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>
                
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>
                
                    </div>
                </div>  		</div>

                <div id="products" class="col-md-10" style="display:none;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Products
                            </div>
                            <div class="panel-body">
        
                                    <div class="container">
        
                                            
                                            @foreach($products as $product)
                                            <section class="col-xs-12 col-sm-6 col-md-12">
                                                <article class="search-result row">
                                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                                        <a href="#" title="Lorem ipsum" class="thumbnail"><img src="{{asset('storage/product_images/'.$product->picture)}}" alt="Lorem ipsum" /></a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                                        <ul class="meta-search">
                                                            <li><span>{{$product->title}}</span></li>
                                                            <li> <span>{{$product->description}}</span></li>
                                                            <li><i class="glyphicon glyphicon-tags"></i> <span>Products</span></li>
                                                            <li><button>Delete</button></li>
                                                        </ul>
                                                    </div>
                                                
                                                </article>
                                        
                                        
                                               		
                                        
                                            </section>
                                            @endforeach
                                        </div>
                            </div>
                        </div>
                    
                    </div>
            <div id="dashboardDiv" class="col-md-10 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dashboard
                    </div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                </div>
            </div>

            <div id="addProductDiv" class="col-md-10" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a Product
                    </div>
                    <div class="panel-body">
                        {!!Form::open(['action'=>'ProductController@createProduct','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                        <div class="form-group">
                            {{Form::text('title','',['class'=>'form-controller','placeholder'=>'title','id'=>'title'])}}
                        </div>
                        <div class="form-group">
                            {{Form::text('price','',['class'=>'form-controller','placeholder'=>'price','id'=>'price'])}}
                        </div>
                        <div class="form-group">
                            {{Form::textarea('body','',['class'=>'form-controller','placeholder'=>'description','id'=>'body'])}}
                        </div>
                        <div class="form-group">
                            {{Form::file('picture')}}
                        </div>
                        {{Form::submit('Add Product')}}
                        {!!Form::close()!!}
                    </div>
            </div>

            
            <script>
            $(document).ready(function(){
                $('#addProductBtn').click(function(){
                    $('#dashboardBtn').removeClass('active');
                    $('#myProductsBtn').removeClass('active');
                    $(this).addClass('active');
                    $('#dashboardDiv').hide();
                    $('#products').hide();
                    $('#addProductDiv').show();
                })

                $('#myProductsBtn').click(function(){
                    $('#dashboardBtn').removeClass('active');
                    $('#addProductBtn').removeClass('active');
                    $(this).addClass('active');
                    $('#dashboardDiv').hide();
                    $('#addProductDiv').hide();
                    $('#products').show();
                })

                $('#dashboardBtn').click(function(){
                    $('#addProductBtn').removeClass('active');
                    $('#myProductsBtn').removeClass('active');
                    $(this).addClass('active');
                    $('#addProductDiv').hide();
                    $('#products').hide();
                    $('#dashboardDiv').show();
                });

                

                
        });
            </script>
            
                          <footer class="pull-left footer">
                              <p class="col-md-12">
                                  <hr class="divider">
                                  Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
                              </p>
                          </footer>
                      </div>
            </div>
        </div>
    </div>
</div>

@endsection

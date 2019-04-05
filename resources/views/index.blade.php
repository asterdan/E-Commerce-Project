@extends('layouts.app')
@section('content')
<div class="jumbotron jumb">
        <div class="search">
                {{Form::open(['action'=>'SearchController@search','method'=>'POST'])}}
                {!!Form::text('title','',['placeholder'=>'Search...'])!!}
                <div class="icon"></div>
                
                {{Form::close()}}
                
            
            </div>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            Latest products
        </div>
        <div class="card-body">
                <div class="row">
                        @foreach($data['products'] as $product)
                          <div class="col-md-4">
                                <div class="thumbnail">
                                  <img src="{{asset('storage/product_images/'.$product->picture)}}" alt="" class="img-responsive">
                                  <div class="caption">
                                    <h4 class="pull-right">{{$product->price}} $</h4>
                                    <h4><a href="#">{{$product->title}}</a></h4>
                                    <p>{{$product->description}}</p>
                                  </div>
                                  <div class="ratings">
                                    <p>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                       (15 reviews)
                                    </p>
                                  </div>
                                  <div class="space-ten"></div>
                                  <div class="btn-ground text-center">
                                    <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i><a href="/productDetail/{{$product->id}}" style="color:white">View more</a></button>
                                  </div>
                                  <div class="space-ten"></div>
                                </div>
                              </div>
                              
                      @endforeach
                            </div>
        </div>
    </div>
       
</div>

<script>
    $(document).ready(function(){
    $('.icon').click(function(){
        $('.search').toggleClass('active');
    });
});
</script>
@endsection
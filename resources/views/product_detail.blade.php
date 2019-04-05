@extends('layouts.app')
@section('content')
			<div class="container">
					<div class="card" style="padding:5px;">
						<div class="container-fliud">
							<div class="wrapper row">
								<div class="preview col-md-3">
									
									<div class="preview-pic tab-content">
										<div class="tab-pane active" id="pic-1"><img src="{{asset('storage/product_images/'.$product->picture)}}" style="width:100%"/></div>
									</div>
									
									
								</div>
								<div class="details col-md-6">
									<h3 class="product-title" >{{$product->title}}</h3>
									<div class="rating">
										<div class="stars">
											@if($product->product_rating<40)
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											@elseif($product->product_rating<60)
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											@elseif ($product->product_rating>60)
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											@elseif ($product->product_rating>80)
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											@elseif ($product->product_rating>90)
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											@endif
										</div>
										<span class="review-no">{{$product->product_rating}}% i vleresuar</span>
									</div>
									<p class="product-description">{{$product->description}}.</p>
													<h4 class="price">current price: <span >{{$product->price}} $</span></h4>
									<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
									<h5 class="sizes">sizes:
										<span class="size" data-toggle="tooltip" title="small">s</span>
										<span class="size" data-toggle="tooltip" title="medium">m</span>
										<span class="size" data-toggle="tooltip" title="large">l</span>
										<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
									</h5>
									<h5 class="colors">colors:
										<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
										<span class="color green"></span>
										<span class="color blue"></span>
									</h5>
									<div class="action">
										<button class="add-to-cart btn btn-default" type="button">add to cart</button>
										<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
									
										{!!Form::open(['action'=>'PaymentController@create','method'=>'POST'])!!}
										<input type="hidden" id="productId" value="{{$product->id}}" name="product_id" />
										<input type="hidden" id="productName" value="{{$product->title}}" name="product_name" />
										<input type="hidden" id="productPrice" value="{{$product->price}}" name="product_price" />
										<input type="hidden" id="userId" value="{{Auth::user()->id}}" name="user_id" />
										<br/>
								
										{{Form::submit('Buy',['class'=>'add-to-cart btn btn-default'])}}
										{!!Form::close()!!}
										</form>
										
			
			
									</div>
								</div>
							</div>
							<div class="wrapper row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
												<div class="col-md-12 text-center">
														<div class="well">
															<h4>What is on your mind?</h4>
													<form id="reviewForm">
														<div class="input-group">
															<input type="textarea" id="userComment" name="review" class="form-control input-sm chat-input" placeholder="Write your review here..." />
															<input type="hidden" value="{{$product->id}}" name="product_id" />
															<span class="input-group-btn" id="btnAdd">     
																<a href="#" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-comment"></span> Add Review</a>
															</span>
														</div>
													</form>
													<form id="getReviews">
														<input type="hidden" value="{{$product->id}}" name="product_id" />	
													</div>
										</div>
										<div id="cardBody" class="card-body">
												
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function(){

						function getReviews()
						{
							$.ajax({
							headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
							url:'http://localhost:8000/getReviews',
							type:'POST',
							data: $('#getReviews').serialize(),
							processData:false,
							success:function(data)
							{
								$('#cardBody').html(data);
							},
							error: function(jqXhr,textStatus,errorThrown)
							{
								alert(jqXhr.responseText);
							}
						    });
						}

						getReviews();
						
							

						$('#btnAdd').click(function(){
							$.ajax({
							headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
							url:'http://localhost:8000/postReview',
							type:'POST',
							data: $('#reviewForm').serialize(),
							processData:false,
							success:function(data)
							{
								getReviews();
							},
							error: function(jqXhr,textStatus,errorThrown)
							{
								alert(jqXhr.responseText);
							}
						});
					});
				});
					
				</script>
@endsection


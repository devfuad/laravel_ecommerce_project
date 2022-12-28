@extends('frontend.master')

@section('content')

 <!-- ======================= Top Breadcrubms ======================== -->
 <div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Support</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form>
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                <input type="text" name="name" value="{{Auth::guard('customerlogin')->user()->name}}" class="form-control" placeholder="First Name" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                <input type="email" name="email" value="{{Auth::guard('customerlogin')->user()->email}}" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Company</label>
                                <input type="text" name="company" class="form-control" placeholder="Company Name (optional)" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone" class="text-dark">Mobile Number *</label>
                                <input type="tel" name="mobile" class="form-control" placeholder="Mobile Number" />
                            </div>
                        </div>
                        
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            <div class="form-group">
                                <label class="text-dark">Address *</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" />
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                            <div class="form-group">
                                <label class="text-dark">ZIP / Postcode *</label>
                                <input type="number" name="zip" class="form-control" placeholder="Zip / Postcode" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Country *</label>
                                <select class="custom-select" name="country_id">
                                  <option value="">-- Select Country --</option>
                                  <option value="1" selected="">Bangladesh</option>
                                  <option value="2">United State</option>
                                  <option value="3">United Kingdom</option>
                                  <option value="4">China</option>
                                  <option value="5">Pakistan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">City *</label>
                                <select class="custom-select" name="city_id">
                                  <option value="">-- Select City --</option>
                                  <option value="1" selected="">Bangladesh</option>
                                  <option value="2">United State</option>
                                  <option value="3">United Kingdom</option>
                                  <option value="4">China</option>
                                  <option value="5">Pakistan</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Additional Information</label>
                                <textarea name="notes" class="form-control ht-50"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
            
            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items ({{$carts->count()}})</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        @foreach ($carts as $cart)
                            
                       
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="{{asset('uploads/product/preview')}}/{{$cart->rel_to_product->preview}}" alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{$cart->size_id == null?'NA':$cart->rel_to_size->size_name}}</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{$cart->color_id == null?'NA':$cart->rel_to_color->color_name}}</span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">TK {{$cart->rel_to_product->after_discount}} x {{$cart->quantity}}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
 
                    </ul>
                </div>
                
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Delivery Location</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c1" class="radio-custom" name="charge" type="radio">
                                <label for="c1" class="radio-custom-label">Inside City</label>
                            </li>
                            <li>
                                <input id="c2" class="radio-custom" name="charge" type="radio">
                                <label for="c2" class="radio-custom-label">Outside City</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Select Payment Method</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c3" class="radio-custom" name="payment_method" type="radio">
                                <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                            </li>
                            <li>
                                <input id="c4" class="radio-custom" name="payment_method" type="radio">
                                <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                            </li>
                            <li>
                                <input id="c5" class="radio-custom" name="payment_method" type="radio">
                                <label for="c5" class="radio-custom-label">Pay With Stripe</label>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card mb-4 gray">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">TK {{session('checkout_subtotal')}}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Charge</span> <span class="ml-auto text-dark ft-medium">$10.10</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium">$108.22</span>
                      </li>
                    </ul>
                  </div>
                </div>

                
                <a class="btn btn-block btn-dark mb-3" href="checkout.html">Place Your Order</a>
            </div>
            
        </div>
        
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->

<!-- ============================= Customer Features =============================== -->
<section class="px-0 py-3 br-top">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shopping-basket theme-cl"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Free Shipping</h5>
                        <span class="text-muted">Capped at $10 per order</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="far fa-credit-card theme-cl"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Secure Payments</h5>
                        <span class="text-muted">Up to 6 months installments</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shield-alt theme-cl"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">15-Days Returns</h5>
                        <span class="text-muted">Shop with fully confidence</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-headphones-alt theme-cl"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">24x7 Fully Support</h5>
                        <span class="text-muted">Get friendly support</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Customer Features ======================== -->

@endsection
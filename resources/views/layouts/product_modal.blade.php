<!-- Modal area start -->
<div class="modal fade" id="product-Modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body d-flex">
                <div class="product-single-img w-50" id="thumbnail_picture">
                    {{-- <img src="assets/images/product/product-details.jpg" alt=""> --}}
                </div>
                <div class="product-single-content w-50">
                    <h3 id="product_name"></h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">$<span id="price"></span></span>
                        <ul class="rating pull-right">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li>(05 Customar Review)</li>
                        </ul>
                    </div>
                    <div id="short_description">

                    </div>

                    <ul class="input-style">
                      <div id="quantity" class="text-danger">

                      </div>
                      <form action="{{ url('add/to/cart') }}" method="post" id="Activeity">
                        @csrf
                        <div id="product_id">

                        </div>
                        <li class="quantity cart-plus-minus">
                            <input type="text" value="1" name="quantity"/>
                        </li>
                        {{-- <li><a href="">Add to Cart</a></li> --}}
                        <li id="addButton"></li>
                      </form>
                    </ul>

                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#" id="category_name"></a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal area end -->

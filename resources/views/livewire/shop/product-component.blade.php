<div>
    <div class="row mb-3 align-items-center">
        <div class="col-lg-6 mb-2 mb-lg-0">
        <p class="text-small text-muted mb-0">Showing 1–12 of 53 results</p>
        </div>
        <div class="col-lg-6" wire:ignore>
        <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
            <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
            <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
            <li class="list-inline-item">
            <select class="selectpicker ml-auto" wire:model="sorting" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                <option value="default">Default sorting</option>
                <option value="popularity">Popularity</option>
                <option value="low-high">Price: Low to High</option>
                <option value="high-low">Price: High to Low</option>
            </select>
            </li>
        </ul>
        </div>
    </div>
    <div class="row">
        <!-- PRODUCT-->
        @foreach ($products as $product)
        <div class="col-lg-4 col-sm-6">
        <div class="product text-center">
            <div class="mb-3 position-relative">
            <div class="badge text-white badge-"></div><a class="d-block" href="{{route('shop.details')}}"><img class="img-fluid w-100" src="img/product-1.jpg" alt="..."></a>
            <div class="product-overlay">
                <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                </ul>
            </div>
            </div>
            <h6> <a class="reset-anchor" href="{{route('shop.details')}}">{{ $product->name }}</a></h6>
            <p class="small text-muted">${{ number_format($product->price /100 , 2 , ',') }}</p>
        </div>
        </div>
        @endforeach
        <div class="col-lg-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center justify-content-lg-end">
                    {{ $products->links() }}
                </ul>
            </nav>
        </div>

    </div>
</div>

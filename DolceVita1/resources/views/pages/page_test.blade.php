@foreach($products as $product)
        <div class="col-md-3 col-sm-6">
            <a href="{{route('categorii.detalii',['categorii'=>$product->categories->descriere,'detalii'=>$product->nume] )}}" class="title">
                <figure class="card card-product">
                    @if ($loop->iteration==1 or $loop->iteration==2 or $loop->iteration==3)
                                <span class="badge-new"> NEW </span>				
                    @endif
                    <div class="img-wrap"> <img src="{{asset('storage/'.$product->img)}}"></div>
                    <figcaption class="info-wrap">
                        {{$product->nume}}
                        <div class="price-wrap">
                            <span class="price-new">{{$product->priceFormat()}}</span> 
                        </div> <!-- price-wrap.// -->
                    </figcaption>
                </figure> 
            </a><!-- card // -->
        </div> <!-- col // -->
        @endforeach 
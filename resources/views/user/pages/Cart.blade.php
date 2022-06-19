<x-app-layout>
    @include('../user/components/home/NavMenu')
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

    @php
    if(Auth::check() == null){
    @endphp
    <section>
        <div class="container" style="margin-top: 100px;">
            <div class="alert alert-warning" role="alert">
                Please Login
            </div>
        </div>
    </section>
    @php
    }elseif(COUNT($cart)!=0){
    @endphp

    <section>
        <div class='section-title text-center mt-5 '>
            <h2>CART</h2>
        </div>
        <div class="container" style="margin-top:100px;">
            <div class="row">
                <table>
                    <tr class=" border rounded bg-white">
                        <th style="text-align: left; padding-left: 15px;">PRODUCT</th>
                        <th style="text-align: left; width: 250px; padding-left: 50px;">NAME</th>
                        <th style="text-align: left;">UNIT PRICE</th>
                        <th style="text-align: left;">QTY</th>
                        <th style="text-align: left;">TOTAL PRICE</th>
                        <th></th>
                    </tr>

                    @php
                    $productTotal = 0;
                    $qtyErrors = 0;
                    $outOfStock = 0;
                    $outOfStockName = array();

                    @endphp
                    <!-- @foreach($cart as $product)
                    @php
                       $productTotal += ($product['PrtPrice']*$product['PrtQty']);
                    @endphp
                    @endforeach -->


                    @foreach($cart as $product)
                    @foreach($ProductDetails as $productDet)
                    @php

                    if($productDet['product_id'] == $product['PrtID']){
                    if($productDet['quantity'] < $product['PrtQty']){ $outOfStock++; array_push($outOfStockName,$product['PrtName']); } } @endphp @endforeach @endforeach @foreach($cart as $product) @if($product['PrtQty']>10)
                        @php
                        $qtyErrors++;
                        @endphp

                        @endif

                        <tr class=" border rounded bg-white">
                            <td class="col-12 col-md-2">
                                <img src="{{$product['PrtImage']}}" style="width:150px;height:150px;" />
                            </td>
                            <asp:Label ID="lblPrtID" runat="server" Text='<%# Eval("prtID") %>' Visible="False"></asp:Label>
                            <td class="col-12 col-md-2" width="30%">
                                {{$product['PrtName']}}
                            </td>

                            <td class="col-12 col-md-2">RM
                                {{$product['PrtPrice']}}
                            </td>
                            <td class="col-12 col-md-2">
                                {{$product['PrtQty']}}
                            </td>
                            <td class="col-12 col-md-2">RM {{($product['PrtPrice']*$product['PrtQty'])}}</td>

                            <td>
                                <a href="{{route('Cart.Remove',$product->PrtID)}}" id="delete" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>


                        @endforeach

                        <tr class=" border rounded bg-white">
                            <td colspan="4">
                                <h5>Total Payment</h5>
                            </td>
                            <td>RM
                                {{$total}}
                                <!-- @php
                            echo($productTotal);
                            @endphp -->
                            </td>
                            <td>

                            </td>
                        </tr>

                </table>

                @if($qtyErrors > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error </strong> Every single product quantity cannot more than 10
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif($outOfStock > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Out of stock: </strong>
                    @php

                    foreach($outOfStockName as $prtName){
                    echo($prtName." - ");
                    }
                    @endphp


                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @else
                <a href="{{route('Payment.Page','abc123')}}" class="btn btn-info">Proceed</a>

                @endif
            </div>
        </div>

    </section>

    @php
    }else{
    @endphp

    <section>
        <div class="container" style="margin-top: 100px;">
            <div class="alert alert-warning" role="alert">
                The cart was empty. Please add something to the cart. <a href="{{route('productsPage')}}" class="alert-link">Product Page</a>
            </div>
        </div>
    </section>
    @php
    }
    @endphp


    <!--app JS-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();

                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })


            });
        });
    </script>

    @include('../user/components/home/Footer')

</x-app-layout>
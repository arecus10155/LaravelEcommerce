<x-app-layout>
    @include('../user/components/home/NavMenu')
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

    <section>
        <div class='section-title text-center mt-5 '>
            <h2>MY ORDER</h2>
        </div>

        <div class="container" style="width:50%; margin-top:45px;">
            <div style="display:inline-block;">
                <a href="{{route('my.order')}}" class="btn btn-outline-primary">All ORDER</a>
                <a href="{{route('myTOSHIP.order')}}" class="btn btn-outline-primary">TO SHIP</a>
                <a href="{{route('myTORECEIVE.order')}}" class="btn btn-outline-primary">TO RECEIVE</a>
                <a href="{{route('myRECEIVED.order')}}" class="btn btn-outline-primary">RECEIVED</a>              
            </div>

            <div style="display:inline-block; margin-left:90px;">
                {{$orders->links('vendor.pagination.custom')}}
            </div>

            <div class="row" style="margin-top:10px;">
                <table>
                    <tr class=" border rounded bg-white" height="50px">
                        <th style="text-align: left; padding-left: 15px;">No.</th>
                        <th style="text-align: left;">Order ID</th>
                        <th style="text-align: left;">Place Date</th>
                        <th style="text-align: left;">Order Status</th>
                        <th></th>
                    </tr>
                    
                    @foreach($orders as $item)
                    <tr class=" border rounded bg-white" height="50px">
                        <asp:Label ID="lblPrtID" runat="server" Text='' Visible="False"></asp:Label>
                        <td style="padding-left: 15px;" class="col-12 col-md-2">{{$orders->firstItem()+$loop->index}}</td>

                        <td class="col-12 col-md-2">{{$item->OrderID}}</td>

                        <td class="col-12 col-md-2">{{$item->DateTime}}</td>

                        @if($item->Status == "TOSHIP")
                            <td class="col-12 col-md-2"><span style="color: red; font-weight:bold; ">{{$item->Status}}</span></td>
                        @elseif($item->Status == "TORECEIVE")
                            <td class="col-12 col-md-2"><span style="color: orange; font-weight:bold;">{{$item->Status}}</span></td>
                        @elseif($item->Status == "RECEIVED")
                            <td class="col-12 col-md-2"><span style="color: green; font-weight:bold;">{{$item->Status}}</span></td>
                        @endif


                        <td>
                            <a href="{{route('Receipt',$item->OrderID)}}" style="height: 35px;" class="btn btn-primary">View Details</a>
                            @if($item->Status == 'TORECEIVE')
                                <a href="{{route('receiveOrder.order',$item->OrderID)}}" id="receive" style="height: 35px; width: 90.54px;" class="btn btn-success">Receive</a>
                            @else
                                <button style="height: 35px;"  class="btn btn-secondary" disabled>Received</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </section>

     <!--app JS-->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#receive', function(e) {
                e.preventDefault();

                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure to receive your order?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, receive my order!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Received!',
                            'Your order has been received.',
                            'success'
                        )
                    }
                })


            });
        });
    </script>

    @include('../user/components/home/Footer')

</x-app-layout>
@extends('layouts.app')
@section('title', 'Cart')
@section('content')
    <div class="container">
        <div class="text-right">
            <a href="{{ url('/empty-cart') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Empty Cart</a>
        </div>
        <br/>
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0 ?>
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset('img/' . $details['photo']) }}" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <div class="nomargin">{{ $details['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td data-th="Quantity" class="text-center">{{ $details['quantity'] }}
                            <!--
                            <input min="1" type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                        -->
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <a href="{{ url('/remove-cart/' . $id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <!--
                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm remove-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                            -->
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total {{ $total }}</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <a href="{{ url('/login') }}" class="btn btn-info"><i class="fa fa-shopping-cart"></i> Order, I've an account</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Order, I've not account</a>
                </td>
                <td class="hidden-xs text-right"><strong>Total ${{ $total }}</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
        $(".remove-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
        $(".empty-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('empty-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
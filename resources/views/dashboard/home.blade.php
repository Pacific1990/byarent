@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('cart'))
    <div class="row">
        <div class="col-md-12 text-right">
                <a href="{{ url('/order') }}" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> Please, Confirm your order</a>
        </div>
    </div>
    <br/>
    @endif

    @if(Auth::user()->group_id == 1)
    <div class="row">
        <div class="col-md-4">
            <div class="charts">
                <div class="counter">{{ $total['houses'] }}</div>
                <div>Houses</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="charts">
                <div class="counter">{{ $total['users'] }}</div>
                <div>Users</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="charts">
                <div class="counter">{{ $total['orders'] }}</div>
                <div>Orders</div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->group_id == 2)
    <div class="row">
        <div class="col-md-12">
            @if ($values)
            <h4>Mes commandes</h4>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" width="5%">#</th>
                    <th>Houses</th>
                    <th class="text-center" width="10%">Qty</th>
                    <th class="text-center" width="10%">Date</th>
                    <th class="text-center" width="10%">Time</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach ($values as $value)
                    <tr>
                        <td class="text-center" width="5%">{!! $i++ !!}</td>
                        <td class=""><strong>{!! \App\Models\House::find($value->house_id)->name !!}</strong></td>
                        <td class="text-center" width="10%"><strong>{!! $value->quantity !!}</strong></td>
                        <td class="text-center" width="10%"><strong>{!! $value->date !!}</strong></td>
                        <td class="text-center" width="10%"><strong>{!! $value->time !!}</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                @endif
        </div>
    </div>
    @endif
</div>
@endsection

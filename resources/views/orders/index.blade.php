@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="panel-title">{{ $page['title']  }}</h3>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('ok'))
                        <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                    @endif
                    @if($values)
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th>Houses</th>
                                    <th>Users</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach ($values as $value)
                                    <tr>
                                        <td class="text-center" width="5%">{!! $i++ !!}</td>
                                        <td class="text-primary"><strong>{!! \App\Models\House::find($value->house_id)->name !!}</strong></td>
                                        <td class="text-primary"><strong>{!! \App\Models\User::find($value->user_id)->name !!}</strong></td>
                                        <td class="text-primary"><strong>{!! $value->quantity !!}</strong></td>
                                        <td class="text-primary"><strong>{!! $value->date !!}</strong></td>
                                        <td class="text-primary"><strong>{!! $value->time !!}</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

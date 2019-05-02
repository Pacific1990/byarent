@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <img src="{{ asset('img/home.png' ) }}" width="100%" height="400">
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            @if($values)
                @foreach($values as $value)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ asset('img/' . $value->picture) }}" width="100%" height="225">
                            <div class="card-body">
                                <div class="card-title text-blue bolder">{{ $value->name }} ( <i class="text-red text-right">{{ $value->rent ? 'For rent' : 'For sale' }}</i> )</div>
                                <p class="card-text" style="height: 50px;">{{ str_limit(strtolower($value->description), 50) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ url('insert-cart/'.$value->id) }}" role="button" class="btn btn-sm btn-warning">Add</a>
                                        <a href="{{ url('detail/'.$value->id) }}" role="button" class="btn btn-sm btn-secondary">See</a>
                                    </div>
                                    <small class="text-muted  bolder text-blue">$ {{ $value->price }} </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection


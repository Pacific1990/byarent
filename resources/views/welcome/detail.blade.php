@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div>
                    <img src="{{ asset('img/' . $value->picture) }}" width="100%" height="150">
                </div>
                <br/>
                <br/>
                <div>
                    <img src="{{ asset('img/' . $value->picture) }}" width="100%" height="150">
                </div>
                <br/>
                <br/>
                <div>
                    <img src="{{ asset('img/' . $value->picture) }}" width="100%" height="150">
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('img/' . $value->picture) }}" width="100%" height="400">
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <h4 class="text-blue">{{ $value->name  }}</h4>
                        <p>{{ $value->description  }}</p>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="bolder">$ {{ $value->price  }}</div>
                            </div>
                            <div class="col-md-8 text-right">
                                <div class="btn-group">
                                    <a href="{{ url('insert-cart/'.$value->id) }}" role="button" class="btn btn-sm btn-warning">Add</a>
                                    <a href="{{ url('detail/'.$value->id) }}" role="button" class="btn btn-sm btn-secondary">See</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


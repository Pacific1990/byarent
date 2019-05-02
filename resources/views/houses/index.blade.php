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
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ url ($page['module'].'/create') }}"><i class="fa fa-add"></i></a>
                    </div>
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
                                <th>Title</th>
                                <th class="text-center" width="5%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach ($values as $value)
                                <tr>
                                    <td class="text-center" width="5%">{!! $i++ !!}</td>
                                    <td class="text-primary"><strong>{!! $value->name !!}</strong></td>
                                    <td class="text-center" width="5%">
                                        <a href="{{ url($page['module'].'/show/'. $value->id) }}" class=""><i class="fa fa-eye"></i></a>
                                        <a href="{{ url($page['module'].'/edit/'. $value->id) }}" class=""><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url($page['module'].'/destroy/'. $value->id) }}" class=""><i class="fa fa-trash"></i></a>
                                    </td>
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

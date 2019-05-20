@extends('layout')
@section('title')@lang('address-book.search')@endsection
@section('content') 

    <div class="title m-b-md">
        <small> <a href="{{route('home')}}" title="@lang('address-book.go_home')" > <i class="fa fa-angle-left"></i> </a> </small>
        @lang('address-book.search',['term'=>$request->term])
    </div>

    <div class="links">

        {{ Form::open(['url' => route('search'), 'method'=>'get'] ) }}
            {{ Form::text("term", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.search'), ]) }}
            <button class="btn btn-primary" type="submit" title="@lang('address-book.buttons.search')"><i class="fa fa-search"></i></button>
        {{ Form::close() }}
 
        @foreach($contacts as $contact )
            <a href="{{route('contacts.show',['contact'=>$contact->id] ) }}">{{$contact->first}} {{$contact->last}}</a>
        @endforeach

    </div>

@endsection

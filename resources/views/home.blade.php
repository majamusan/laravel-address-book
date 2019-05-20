@extends('layout')
@section('title')@lang('address-book.page_titles.home')@endsection
@section('content') 

    <div class="title m-b-md">
        @lang('address-book.title')
    </div>

    {{ Form::open(['url' => route('contacts.store'), 'method'=>'post'] ) }}
        {{ Form::token() }}
        {{ Form::text("first", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.name_first'), ]) }}
        {{ Form::text("last", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.name_last'), ]) }}
        {{ Form::text("email", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.email'), ]) }}
        {{ Form::text("phone", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.phone'), ]) }}
        <button class="btn btn-success" type="submit" title="@lang('address-book.buttons.create')"><i class="fa fa-save"></i></button>
    {{ Form::close() }}
 
    <div class="links">
        @foreach($contacts as $id => $name)
            <a href="{{route('contacts.show',['contact'=>$id] ) }}">{{$name}}</a>
        @endforeach
    </div>

    {{ Form::open(['url' => route('search'), 'method'=>'get'] ) }}
        {{ Form::text("term", '', [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.search'), ]) }}
        <button class="btn btn-primary" type="submit" title="@lang('address-book.buttons.search')"><i class="fa fa-search"></i></button>
    {{ Form::close() }}
   
@endsection

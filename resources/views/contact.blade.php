@extends('layout')
@section('title')@lang('address-book.page_titles.home')@endsection
@section('content') 

    <div class="title m-b-md">
        <small> <a href="{{route('home')}}" title="@lang('address-book.go_home')" > <i class="fa fa-angle-left"></i> </a> </small>
        {{$contact->first}} {{$contact->last}}
    </div>

    <h2>
        @foreach($contact->details as $item)
        <div class="text-left">
            
            @if($item->type == 'email')
                <a href="mailto:{{$item->data}}" >
                    <i class="fa fa-envelope" title="@lang('address-book.types.'.$item->type)"></i>
                    {{$item->data}}
                </a>
            @elseif($item->type == 'phone')
                <a href="tel:{{$item->data}}" >
                    <i class="fa fa-phone" title="@lang('address-book.types.'.$item->type)"></i>
                    {{$item->data}}
                </a>
            @else
                {{$item->data}}
            @endif
        </div>
        @endforeach
    </h2>

    <div class="card-body">
        {{ Form::open(['url' => route('contacts.update',['contact'=>$contact->id ] ), 'method'=>'post','class' => 'd-inline-block'] ) }}
            {{ method_field('PUT') }}
            {{ Form::token() }}
            {{ Form::text("first", $contact->first, [ "placeholder" => __('address-book.placeholders.name_first'), ]) }}
            {{ Form::text("last",  $contact->last, [ "placeholder" => __('address-book.placeholders.name_last'), ]) }}
            <button class="btn btn-primary" type="submit" title="@lang('address-book.buttons.update')"><i class="fa fa-save"></i></button>
        {{ Form::close() }}
        {{ Form::open(['url' => route('contacts.destroy',['contact'=>$contact->id ] ), 'type'=>'post','class' => 'd-inline-block'] ) }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger" type="submit" title="@lang('address-book.buttons.delete')"><i class="fa fa-trash"></i></button>
        {{ Form::close() }}
    </div>

    @foreach($contact->details as $item)
        <div class="">

            {{ Form::open(['url' => route('details.update',['detail'=>$item->id ] ), 'type'=>'post','class' => 'd-inline-block'] ) }}
                {{ method_field('PUT') }}
                {{ Form::token() }}
                {{ Form::text("data", $item->data, [ "class" => "form-group ", "placeholder" => __('address-book.placeholders.phone'), ]) }}
                <button class="btn btn-primary" type="submit" title="@lang('address-book.buttons.update')"><i class="fa fa-save"></i></button>
            {{ Form::close() }}

            {{ Form::open(['url' => route('details.destroy',['detail'=>$item->id ] ), 'type'=>'post','class' => 'd-inline-block' ] ) }}
                {{ method_field('DELETE') }}
                <button class="btn btn-warning" type="submit" title="@lang('address-book.buttons.delete')"><i class="fa fa-trash"></i></button>
            {{ Form::close() }}
        </div>
    @endforeach

    <div class="card-body">
        {{ Form::open(['url' => route('details.store'), 'type'=>'post','class' => 'd-inline-block' ] ) }}
            {{ Form::token() }}
            {{ Form::hidden('contacts_id',$contact->id) }}
            {{ Form::select("type", ['email'=>__('address-book.types.email'),'phone'=> __('address-book.types.phone') ],[ "class" => "form-group ", ]) }}
            {{ Form::text("data", '',[ "class" => "form-group ", "placeholder" => __('address-book.placeholders.data'), ]) }}
            <button class="btn btn-success" type="submit" title="@lang('address-book.buttons.create')"><i class="fa fa-save"></i></button>
        {{ Form::close() }}
    </div>

@endsection

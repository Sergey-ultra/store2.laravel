@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $skus->product->__('name') }}</h1>
    <h2>{{ $skus->product->category->name }}</h2>
    <p>@lang('product.price'): <b>{{ $skus->price }} {{ $currencySymbol }}</b></p>
    @isset($skus->product->properties)
        @foreach($skus->propertyOptions as $propertyOption)
            <h4>{{ $propertyOption->property->__('name') }}:{{ $propertyOption->__('name') }}</h4>
        @endforeach
    @endisset
    <img src="{{ Storage::url($skus->product->image) }}">
    <p>{{ $skus->product->__('description') }}</p>

        @if ($skus->isAvailable())
            <form action="{{ route('basket-add', $skus->product) }}" method="POST">
                <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
                @csrf
            </form>
        @else
            <span>Не доступен</span>
            <br>
            <span>Сообщить мне, когда товар появиться в наличии:</span>
                <span class="warning">
                     @if($errors->get('email'))
                        {!! $errors->get('email')[0] !!}
                    @endif
                </span>

            <form method="POST" action="{{ route('subscribe', $skus) }}">
                <input type="text" name="email">
                <button type="submit" class="btn btn-default">Отправить</button>

                @csrf
            </form>
        @endif


@endsection

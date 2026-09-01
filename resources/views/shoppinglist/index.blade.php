@extends('layouts.app')

@section('title','買い物リスト')

@section('content')

    <ul>
        @foreach ($shoppingList as $name => $item)
            <li>
                <form action="/ingredient/{{ $item['id'] }}/toggle" method="POST">
                    @csrf
                    <input type="checkbox" onchange="this.form.submit()"
                        {{ $item['is_checked']? 'checked' : '' }}>
                    {{ $name }} ×{{ $item['count'] }}
                </form>
            </li>
        @endforeach
    </ul>

@endsection
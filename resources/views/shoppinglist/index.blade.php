@extends('layouts.app')

@section('title','買い物リスト')

@section('content')

    <h2 class="section-label">今週必要な材料</h2>

    <div class="shopping-card">
        <ul class="shopping-list">
            @foreach ($shoppingList as $name => $item)
                <li class="shopping-item">
                    <form action="/ingredient/{{ $item['id'] }}/toggle" method="POST">
                        @csrf
                        <label class="shopping-item__label">
                            <input type="checkbox" class="shopping-item__checkbox" 
                                onchange="this.form.submit()"
                                {{ $item['is_checked']? 'checked' : '' }}>
                            <span class="shopping-item__name">{{ $name }}</span>
                            <span class="shopping-item__count"> ×{{ $item['count'] }}</span>
                        </label>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
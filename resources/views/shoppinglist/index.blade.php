<h1>買い物リスト</h1>

<ul>
    @foreach ($shoppingList as $name => $count)
        <li>{{ $name }} *{{ $count }}</li>
    @endforeach
</ul>
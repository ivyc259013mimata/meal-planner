<h1>材料一覧</h1>

<form action="/ingredient/store" method="POST">

    @csrf
    <input type="text" name="name" placeholder="材料名を入力">
    <button type="submit">追加</button>
</form>

@foreach ($ingredients as $ingredient)

    <p> {{ $ingredient->name }}</p>
@endforeach
    
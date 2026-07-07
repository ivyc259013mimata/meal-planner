<h1>レシピ一覧</h1><!-- 画面のタイトル -->

<form action="/recipe" method="get">
    <!-- 検索フォーム。getなので「見るだけ」の処理として送る -->
    <input type="text" name="search">
    <button type="submit">検索</button>
</form>

@foreach ($recipes as $recipe)
<!-- $recipes（複数のレシピ）を、1件ずつ繰り返して表示する -->

    <h3>{{ $recipe->name}}</h3>
    <!-- レシピ名を表示 -->

    <p>{{ $recipe->category}}</p>
    <!-- カテゴリを表示 -->

    @foreach ($recipe->ingredients as $ingredient)
    <span>{{ $ingredient->name }}</span>{{-- このレシピに紐づいてる材料を1つずつ表示 --}}
    @endforeach

    <a href="/recipe/{{ $recipe->id }}/edit">編集</a>

    <form action="/recipe/{{ $recipe->id}}/delete" method="POST">
        @csrf
        {{-- /recipe/{id}/deleteにPOSTで送る --}}
        <button type="submit">削除</button>
    </form>

@endforeach
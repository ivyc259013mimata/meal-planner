<h1>レシピ一覧</h1><!-- 画面のタイトル -->

<form action="/recipe" method="get">
    <!-- 検索フォーム。getなので「見るだけ」の処理として送る -->
    <input type="text" name="search">
    <button type="submit">検索</button>
<form>

@foreach ($recipes as $recipe)
<!-- $recipes（複数のレシピ）を、1件ずつ繰り返して表示する -->

    <h3>{{ $recipe->name}}</h3>
    <!-- レシピ名を表示 -->

    <p>{{ $recipe->category}}</p>
    <!-- カテゴリを表示 -->

@endforeach
<form action="/recipe/{{ $recipe -> id}}/update" method="POST">
    @csrf
    <div>
        <label>レシピ名</label>
        <input type="text" name="name" value="{{ $recipe->name }}">
        
    </div>
    <div>
        <label>カテゴリ</label>
        <input type="text" name="category" value="{{ $recipe->category}}">
</div>
    <button type="submit">更新</button>
</form>
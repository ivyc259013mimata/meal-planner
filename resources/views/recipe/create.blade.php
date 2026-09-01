<form action="/recipe/store" method="POST">
    @csrf
    <div>
        <label>レシピ名</label>
        <input type="text" name="name">
    </div>
    <div>
        <label>カテゴリ</label>
        <input type="text" name="category">
    </div>
    <div>
        <label>種類</label>
        <select name="dish_type">
            <option value="主菜">主菜</option>
            <option value="副菜">副菜</option>
        </select>
    </div>
    <div>
        <label>材料</label>
        @foreach ($ingredients as $ingredient)
            <div>
                <input type="checkbox"
                       name="ingredients[]"
                       value="{{ $ingredient->id }}">
                {{-- name="ingredients[]" の[]は「複数選べる」という意味 --}}
                {{-- value にはidを入れる（どの材料か識別するため） --}}
                <label>{{ $ingredient->name }}</label>
            </div>
        @endforeach
    </div>
    <button type="submit">保存</button>
</form>

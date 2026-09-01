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
    <div>
        <label>種類</label>
        <select name="dish_type">
            <option value="主菜" {{ $recipe->dish_type == '主菜' ? 'selected' : '' }}>主菜</option>
            <option value="副菜" {{ $recipe->dish_type == '副菜' ? 'selected' : '' }}>副菜</option>
        </select>
    </div>
    <div>
        <label>材料</label>
        @foreach($ingredients as $ingredient)
            <label>
                <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}"
                {{ $recipe->ingredients->contains($ingredient->id) ? 'checked' : '' }}>
                {{ $ingredient->name }}
            </label>
        @endforeach
    </div>
    <button type="submit">更新</button>
</form>
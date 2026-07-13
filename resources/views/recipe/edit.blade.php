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
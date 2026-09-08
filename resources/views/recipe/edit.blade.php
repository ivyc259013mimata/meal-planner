@extends('layouts.app')

@section('title', 'レシピを編集')

@section('content')

    <div class="form-card">
        <form action="/recipe/{{ $recipe->id }}/update" method="POST">
            @csrf
            <div>
                <label>レシピ名</label>
                <input type="text" name="name" value="{{ $recipe->name }}" required>
                @error('name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>ジャンル</label>
                <select name="category">
                    <option value="和食" {{ $recipe->category == '和食' ? 'selected' : '' }}>和食</option>
                    <option value="洋食" {{ $recipe->category == '洋食' ? 'selected' : '' }}>洋食</option>
                    <option value="中華" {{ $recipe->category == '中華' ? 'selected' : '' }}>中華</option>
                </select>
                @error('category')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>種類</label>
                <select name="dish_type">
                    <option value="主菜" {{ $recipe->dish_type == '主菜' ? 'selected' : '' }}>主菜</option>
                    <option value="副菜" {{ $recipe->dish_type == '副菜' ? 'selected' : '' }}>副菜</option>
                </select>
                @error('dish_type')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>材料</label>

                @error('ingredients')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <div class="ingredient-search">
                    <input type="text" id="ingredientSearch" placeholder="材料名で検索">
                </div>

                <div class="ingredient-tags" id="ingredientTags">
                    @foreach($ingredients as $ingredient)
                        <label class="ingredient-tag" data-name="{{ $ingredient->name }}">
                            <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" class="ingredient-tag__checkbox"
                                {{ $recipe->ingredients->contains($ingredient->id) ? 'checked' : '' }}>
                            <span class="ingredient-tag__label">{{ $ingredient->name }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="ingredient-not-found" id="ingredientNotFound" style="display:none;">
                    <span id="ingredientNotFoundText"></span>が見つかりません。
                    <button type="button" id="ingredientAddBtn" class="btn-add-ingredient">＋ 新しい材料として追加</button>
                </div>


            </div>
            <button type="submit" class="btn-save">更新</button>
        </form>
    </div>

    <script>
        const ingredientSearch = document.getElementById('ingredientSearch');
        const ingredientTags = document.getElementById('ingredientTags');
        const notFoundArea = document.getElementById('ingredientNotFound');
        const notFoundText = document.getElementById('ingredientNotFoundText');
        const addBtn = document.getElementById('ingredientAddBtn');

        ingredientSearch.addEventListener('input', function () {
            const keyword = this.value.trim();
            const tags = ingredientTags.querySelectorAll('.ingredient-tag');
            let matchCount = 0;

            tags.forEach(function (tag) {
                const name = tag.dataset.name;
                if (name.includes(keyword)) {
                    tag.style.display = 'inline-flex';
                    matchCount++;
                } else {
                    tag.style.display = 'none';
                }
            });

            if (keyword != '' && matchCount === 0) {
                notFoundArea.style.display = 'block';
                notFoundText.textContent = keyword;
            } else {
                notFoundArea.style.display = 'none';
            }
        });

        // 材料タグがクリックされたとき（チェックが変化したとき）の処理
        ingredientTags.addEventListener('change', function (event) {
            if (event.target.classList.contains('ingredient-tag__checkbox')) {
                ingredientSearch.value = '';
                ingredientTags.querySelectorAll('.ingredient-tag').forEach(function (tag) {
                    tag.style.display = 'inline-flex';
                });
                notFoundArea.style.display = 'none';
            }
        });

        addBtn.addEventListener('click', function () {
            const newName = ingredientSearch.value.trim();

            const newTag = document.createElement('label');
            newTag.className = 'ingredient-tag';
            newTag.dataset.name = newName;

            newTag.innerHTML = `
                <input type="checkbox" name="ingredients[]" value="new:${newName}" class="ingredient-tag__checkbox" checked>
                <span class="ingredient-tag__label">${newName}</span>
            `;

            ingredientTags.appendChild(newTag);

            ingredientSearch.value = '';
            ingredientTags.querySelectorAll('.ingredient-tag').forEach(function (tag) {
                tag.style.display = 'inline-flex';
            });
            notFoundArea.style.display = 'none';
        });
    </script>

@endsection
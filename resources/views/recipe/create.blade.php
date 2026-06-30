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
    <button type="submit">保存</button>
</form>

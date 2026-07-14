<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','献立プランナー')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    <header class="app-header">
        <button class="app-header__menu-btn" id="menuBtn">≡</button>
        <span class="app-header__icon">🍴</span>
        <h1 class="app-header__title">@yield('title','献立プランナー')</h1>
    </header>
    
    <nav class="app-nav" id="appNav">
        <a href="/mealplan">献立プランナー</a>
        <a href="/shoppinglist">買い物リスト</a>
        <a href="/recipe">レシピ一覧</a>
        <a href="/recipe/create">レシピを登録</a>
    </nav>

    <main class="app-main">
        @yield('content')
    </main>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const appNav = document.getElementById('appNav');

        menuBtn.addEventListener('click',function() {
            appNav.classList.toggle('is-open');
        });
    </script>
</body>
</html>
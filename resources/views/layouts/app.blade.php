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
        <h1 class="app-header__title">@yield('title', '献立プランナー')</h1>
    </header>

    <nav class="app-nav-drawer" id="appNav">
        <ul class="app-nav-drawer__list">
            <li><a href="/mealplan">献立プランナー</a></li>
            <li><a href="/shoppinglist">買い物リスト</a></li>
            <li><a href="/recipe">メニュー一覧</a></li>
            <li><a href="/recipe/create">メニューを登録</a></li>
        </ul>
    </nav>

    <main class="app-main">
        @yield('content')
    </main>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const appNav = document.getElementById('appNav');
        const headerTitle = document.querySelector('.app-header__icon');
        const headerText = document.querySelector('.app-header__title');

        menuBtn.addEventListener('click', function () {
            appNav.classList.toggle('is-open');
            headerTitle.classList.toggle('is-hidden');
            headerText.classList.toggle('is-hidden');
        });
    </script>
</body>
</html>
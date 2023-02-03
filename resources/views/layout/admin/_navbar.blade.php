<nav class="navbar navbar-expand-lg navbar-dark bg-danger mb-4 p-2 rounded">
    <!-- Логотип и кнопка «Гамбургер» -->
    <a class="navbar-brand" href="#">Admin panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbar-blog" aria-controls="navbar-blog"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
    <div class="collapse navbar-collapse" id="navbar-blog">
        <!-- Этот блок расположен слева -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="{{ route('blog.index') }}">Back to website</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="{{ route('admin.post.index') }}">Посты</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Комментарии</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Категории</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Теги</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Пользователи</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Страницы</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-danger nav-link" href="#">Корзина</a>
            </li>
        </ul>
        <!-- Этот блок расположен справа -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger nav-link" href="">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

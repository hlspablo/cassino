<nav id="navbarContent" class="page__navbar">
    <div class="page__navbar__logo">
        <a class="page__navbar__logo" href="{{ url('/') }}">
            <img src="{{ asset('storage/' . config('setting')->software_logo_white) }}" alt="" style="max-width:100%">
        </a>

        <button class="navbar-toggler-close close-button" type="button">
            <i class="fa-regular fa-circle-xmark"></i>
        </button>
    </div>
    <div class="navbar_menu_list">
        <ul class="navbar_list">
            <li class="navbar_list_links">
                <a href="{{ url('/') }}" title="Como funciona?">
                    <i class="fa-solid fa-house fa-xl mr-2"></i>
                    Visão geral
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="{{ url('painel/affiliates') }}" title="Menu de Afiliado">
                    <i class="fa-solid fa-bullhorn fa-xl mr-2"></i>
                    Menu de Afiliado
                </a>
            </li>

            <div class="mt-5 navbar_menu_title">
                <h4>CATEGORIAS</h4>
            </div>

            @foreach(\App\Models\Category::all() as $category)
                <li class="navbar_list_links">
                    <a href="{{ route('web.category.index', ['slug' => $category->slug]) }}" title="{{ $category->name }}">
                        <i class="{{ $category->image }} fa-xl mr-2"></i>
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach

            <div class="mt-5 navbar_menu_title">
                <h4>INFORMAÇÕES</h4>
            </div>

            <li class="navbar_list_links">
                <a href="{{ url('/como-funciona') }}" title="Como funciona?">
                    <i class="fa-solid fa-circle-question fa-xl mr-2"></i>
                    Como funciona?
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="{{ url('/sobre-nos') }}" title="Sobre Nós">
                    <i class="fa-solid fa-circle-info fa-xl mr-2"></i>
                    Sobre Nós
                </a>
            </li>
        </ul>
    </div>
</nav>

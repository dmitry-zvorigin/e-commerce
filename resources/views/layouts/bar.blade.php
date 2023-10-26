<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4"><ya-tr-span data-index="9-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Sidebar" data-translation="Боковая панель" data-ch="1" data-type="trSpan" data-selected="false">Панель</ya-tr-span></span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        {{-- <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg><ya-tr-span data-index="10-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Home " data-translation=" Главная " data-ch="1" data-type="trSpan">  Главная  </ya-tr-span></a>
        </li>
        <li>
        <a href="#" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg><ya-tr-span data-index="11-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Dashboard " data-translation=" Информационная панель " data-ch="1" data-type="trSpan">  Информационная панель  </ya-tr-span></a>
        </li>
        <li>
        <a href="#" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg><ya-tr-span data-index="12-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Orders " data-translation=" Заказы " data-ch="1" data-type="trSpan">  Заказы  </ya-tr-span></a>
        </li>
        <li>
        <a href="#" class="nav-link link-body-emphasis">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg><ya-tr-span data-index="13-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Products " data-translation=" Продукты " data-ch="1" data-type="trSpan">  Продукты  </ya-tr-span></a>
        </li> --}}
        <li>
            <a href="{{ route('admin.dashboard') }}" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Главная
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Категории
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Продукты
            </a>
        </li>
        <li>
            <a href="{{ route('admin.attribute.index') }}" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Атрибуты
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.index') }}" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Пользователи
            </a>
        </li>
        <li>
            <a href="" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle"></use>
                </svg>
                Отзывы
            </a>
        </li>
    </ul>
</div>


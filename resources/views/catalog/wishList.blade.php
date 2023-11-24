@extends('layouts.app')

@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-sm-3">

                <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg><ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Home " data-translation=" Главная " data-ch="0" data-type="trSpan">  Заказы  </ya-tr-span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg><ya-tr-span data-index="3-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Dashboard " data-translation=" Информационная панель " data-ch="0" data-type="trSpan">  Избранное  </ya-tr-span></a>
                      </li>
                    </ul>
                    <hr>
              </div>
                
            </div>
            <div class="col-sm-9">
                @foreach ($wishLists as $wishList)
                    <x-product-card :product="$wishList->product"/>
                @endforeach
                
            </div>
        </div>
    </div>
@endsection
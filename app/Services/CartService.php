<?php

namespace App\Services;


class CartService
{
    public function addItem(int $productId, int $quantity = 1)
    {
        //TODO Логика добавления товара в корзину
    }

    public function removeItem(int $productId)
    {
        //TODO Логика удаления товара из корзины
    }

    public function getContents() : string
    {
        //TODO Логика получения содержимого корзины
        return 'all';
    }
}

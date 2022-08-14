<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function showBasket()
    {
        if (session('basket')) {
            $basket = session('basket');
            return view('shop.basket', compact('basket'));
        } else {
            $txt = 'Корзина пуста';
            return redirect()->route('skuListPage')->with('danger', $txt);
        }
    }

    public function addToBasket(Sku $sku)
    {
        $basket = session('basket');
        if (isset($basket[$sku->id])) {
            //если существует - увеличить кол-во
            $basket[$sku->id]->countInBasket++;
        } else {
            //иначе - создать
            $sku->countInBasket = 1;
            $basket[$sku->id] = $sku;
        }
        session(['basket' => $basket]);
        
        $txt = 'СКУ '.$sku->id.' добавлено в корзину';
        return redirect()->route('showBasket')->with('success', $txt);
    }

    public function removeFromBasket(Sku $sku)
    {
        $basket = session('basket');
        if ($basket[$sku->id]->countInBasket > 1) {
            //если кол-во больше 1 - уменьшить кол-во
            $basket[$sku->id]->countInBasket--;
        } else {
            //иначе - удалить
            unset($basket[$sku->id]);
        }
        session(['basket' => $basket]);

        $txt = 'СКУ '.$sku->id.' удалено из корзины';
        return redirect()->route('showBasket')->with('warning', $txt);
    }

    public function remuveThisSkuFromBasket(Sku $sku)
    {
        $basket = session('basket');
        unset($basket[$sku->id]);
        session(['basket' => $basket]);

        $txt = 'СКУ '.$sku->id.' полностью удалено из корзины';
        return redirect()->route('showBasket')->with('warning', $txt);
    }

    public function clearBasket()
    {
        session()->flush();
        $txt = 'Корзина очищена';
        return redirect()->route('skuListPage')->with('danger', $txt);
    }
}

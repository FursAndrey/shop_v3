<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
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
            if ($sku->countInBasket < $sku->count) {
                $basket[$sku->id]->countInBasket++;
                $txt = 'СКУ '.$sku->id.' добавлено в корзину';
                $messageType = 'success';
            } else {
                $txt = 'СКУ '.$sku->id.' не доступен для заказа в большем объеме';
                $messageType = 'danger';
            }
        } else {
            //иначе - создать
            $sku->countInBasket = 1;
            $basket[$sku->id] = $sku;
            $txt = 'СКУ '.$sku->id.' добавлено в корзину';
            $messageType = 'success';
        }
        session(['basket' => $basket]);
        
        return redirect()->route('showBasket')->with($messageType, $txt);
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
        session()->forget('basket');
        $txt = 'Корзина очищена';
        return redirect()->route('skuListPage')->with('danger', $txt);
    }

    public function confirmOrderForm()
    {
        if (session('basket')) {
            $basket = session('basket');
            return view('shop.confirmOrder', compact('basket'));
        } else {
            $txt = 'Корзина пуста';
            return redirect()->route('skuListPage')->with('danger', $txt);
        }
    }

    public function confirmOrder(OrderRequest $request)
    {
        if (session('basket')) {
            $basket = session('basket');

            $totalPrice = 0;
            $skus = [];
            //считаем общую сумму и проверяем доступность каждого товара в заказе
            foreach ($basket as $skuInOrder) {
                $priceInBasket = $skuInOrder->price*$skuInOrder->countInBasket;
                $totalPrice += $priceInBasket;

                $sku = Sku::find($skuInOrder->id);
                if ($sku->count < $skuInOrder->countInBasket) {
                    $txt = 'Заказ не доступен в полном объеме.';
                    return redirect()->route('showBasket')->with('danger', $txt);
                }
                $sku->count -= $skuInOrder->countInBasket;
                $skus[$skuInOrder->id] = $sku->toArray();
            }

            $confirm = $request->all();
            $confirm['currency_code'] = 'BYN';
            $confirm['total_price'] = $totalPrice;

            $order = Order::create($confirm);
            session()->forget('basket');

            //обновляем количество товаров в БД
            foreach ($skus as $skuId => $sku) {
                $skuInDB = Sku::find($skuId);
                $skuInDB->update($sku);
            }

            $txt = 'Заказ '.$order->id.' подтвержден.';
            return redirect()->route('skuListPage')->with('success', $txt);
        } else {
            $txt = 'Корзина пуста';
            return redirect()->route('skuListPage')->with('danger', $txt);
        }
    }
}

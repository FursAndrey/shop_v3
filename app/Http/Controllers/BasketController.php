<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderedProduct;
use App\Models\OrderedProperty;
use App\Models\Sku;
use App\MyServices\CurrencyConversion;

use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function showBasket()
    {
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        if (session('basket')) {
            $basket = session('basket');
            return view('shop.basket', compact('basket', 'currencies', 'categories'));
        } else {
            return redirect()->route('skuListPage', compact('currencies', 'categories'))->with('danger', __('flushes.empty_basket'));
        }
    }

    public function addToBasket(Sku $sku)
    {
        $basket = session('basket');
        if (isset($basket[$sku->id])) {
            //если существует - увеличить кол-во
            if ($sku->countInBasket < $sku->count) {
                $basket[$sku->id]->countInBasket++;
                $messageType = 'success';
                $name_flush = 'sku_added_to_basket';
            } else {
                $messageType = 'danger';
                $name_flush = 'sku_not_available_in_more';
            }
        } else {
            //иначе - создать
            $sku->countInBasket = 1;
            $basket[$sku->id] = $sku;
            $messageType = 'success';
            $name_flush = 'sku_added_to_basket';
        }
        session(['basket' => $basket]);
        
        return redirect()->route('showBasket')->with($messageType, __("flushes.$name_flush", ['sku' => $sku->id]));
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

        return redirect()->route('showBasket')->with('warning', __('flushes.sku_deleted_from_basket', ['sku' => $sku->id]));
    }

    public function remuveThisSkuFromBasket(Sku $sku)
    {
        $basket = session('basket');
        unset($basket[$sku->id]);
        session(['basket' => $basket]);

        return redirect()->route('showBasket')->with('warning', __('flushes.sku_deleted_from_basket_at_all', ['sku' => $sku->id]));
    }

    public function clearBasket()
    {
        $currencies = CurrencyConversion::getCurrencies();
        session()->forget('basket');
        return redirect()->route('skuListPage', compact('currencies'))->with('danger', __('flushes.basket_cleared'));
    }

    public function confirmOrderForm()
    {
        $currencies = CurrencyConversion::getCurrencies();
        if (session('basket')) {
            $basket = session('basket');
            return view('shop.confirmOrder', compact('basket', 'currencies'));
        } else {
            return redirect()->route('skuListPage', compact('currencies'))->with('danger', __('flushes.empty_basket'));
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
                    return redirect()->route('showBasket')->with('danger', __('flushes.order_not_available'));
                }
                //цена не должна обновляться
                unset($sku->price);
                $sku->count -= $skuInOrder->countInBasket;
                $skus[$skuInOrder->id] = $sku->toArray();
            }

            $confirm = $request->all();
            $confirm['currency_code'] = CurrencyConversion::getCurCode();
            $confirm['total_price'] = $totalPrice;

            $order = Order::create($confirm);

            //сохраняем инф. о заказанных продуктах
            $orderedProduct['order_id'] = $order->id;
            foreach ($basket as $skuInOrder) {
                $orderedProduct['sku_id'] = $skuInOrder->id_for_view;
                $orderedProduct['name_ru'] = $skuInOrder->product->name_ru;
                $orderedProduct['name_en'] = $skuInOrder->product->name_en;
                $orderedProduct['count'] = $skuInOrder->countInBasket;
                $orderedProduct['price_for_once'] = $skuInOrder->price;
                $orderProduct = OrderedProduct::create($orderedProduct);
                
                //сохраняем инф. о свойствах заказанных продуктов
                $orderedProperty['ordered_product_id'] = $orderProduct->id;
                foreach ($sku->product->properties as $property) {
                    $orderedProperty['property_name_ru'] = $property->name_ru;
                    $orderedProperty['property_name_en'] = $property->name_en;
                    if (isset($sku->property_options)) {
                        foreach ($sku->property_options as $propertyOption) {
                            if ($propertyOption->property->id == $property->id) {
                                $orderedProperty['option_name_ru'] = $propertyOption->name_ru;
                                $orderedProperty['option_name_en'] = $propertyOption->name_en;
                            }
                        }
                    } else {
                        $orderedProperty['option_name_ru'] = '-';
                        $orderedProperty['option_name_en'] = '-';
                    }
                    OrderedProperty::create($orderedProperty);
                }
            }
            session()->forget('basket');

            //обновляем количество товаров в БД
            foreach ($skus as $skuId => $sku) {
                $skuInDB = Sku::find($skuId);
                $skuInDB->update($sku);
            }

            return redirect()->route('checkShow', $order);
        } else {
            $currencies = CurrencyConversion::getCurrencies();
            return redirect()->route('skuListPage', compact('currencies'))->with('danger', __('flushes.empty_basket'));
        }
    }

    public function checkShow(Order $order)
    {
        return view(
            'shop.check', 
            [
                'order' => $order,
                'isPDF' => false,
            ]
        );
    }

    public function checkLoad(Order $order)
    {
        $documentFileName = "check.pdf";
 
        //конфигурация MPDF
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);     
 
        //заголовки для вывода
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];
 
        //подготовка контента
        $document->WriteHTML( 
            view(
                'shop.check', 
                [
                    'order' => $order,
                    'isPDF' => true,
                ]
            )
        );
         
        //сохранение в файл
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
        // return Storage::disk('public')->download($documentFileName);
    }
}

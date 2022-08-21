<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\OrderedProperty;
use App\Models\Sku;

use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;

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

            //сохраняем инф. о заказанных продуктах
            $orderedProduct['order_id'] = $order->id;
            foreach ($basket as $skuInOrder) {
                $orderedProduct['sku_id'] = $skuInOrder->id;
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
                        //хз как правильно
                        if ($sku->property_options[0]->property->id == $property->id) {
                            $orderedProperty['option_name_ru'] = $sku->property_options[0]->name_ru;
                            $orderedProperty['option_name_en'] = $sku->property_options[0]->name_en;
                        }
                        // foreach ($sku->property_options as $propertyOption) {
                        //     if ($propertyOption->property->id == $property->id) {
                        //         $orderedProperty['option_name_ru'] = $propertyOption->name_ru;
                        //         $orderedProperty['option_name_en'] = $propertyOption->name_en;
                        //     }
                        // }
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
            // $txt = 'Заказ '.$order->id.' подтвержден.';
            // return redirect()->route('skuListPage')->with('success', $txt);
        } else {
            $txt = 'Корзина пуста';
            return redirect()->route('skuListPage')->with('danger', $txt);
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
        // Setup a filename 
        $documentFileName = "check.pdf";
 
        // Create the mPDF document
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);     
 
        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];
 
        // Write some simple Content
        $document->WriteHTML( 
            view(
                'shop.check', 
                [
                    'order' => $order,
                    'isPDF' => true,
                ]
            )
        );
         
        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
         
        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
        // return Storage::disk('public')->download($documentFileName);
    }
}

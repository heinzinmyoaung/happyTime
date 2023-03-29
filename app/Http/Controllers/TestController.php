<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Addondetail;
use App\Models\Category;
use App\Models\Foodaddon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;



class TestController extends Controller
{
    //
    public function index()
    {

        // dd(Auth::user());

        // $allSessions = session()->all();
        // dd($allSessions);

        return inertia(
            'Index/Index',
            [
                // 'menus' => Menu::all(),
                'menus' => Menu::all(),
                'categories' => Category::all(),
                'foodaddons' => Foodaddon::all(),
                'addons' => Addon::all(),
                'addondetails' => Addondetail::all(),
                'orders' => Order::all(),
                'orderdetails' => Orderdetail::all()
            ],

        );
    }

    public function store(Request $request)
    {
        // $request->session()->flush();
        // $cart = session()->get('cart');
        // $id = $request->foodid;
        // print_r($id);
        // if (!$cart) {
        //     $cart = [
        //         $id => [
        //             'additionprice' => $request->additionprice,
        //             'quantity'    =>  $request->quantity
        //         ]
        //     ];
        //     session()->put('cart', $cart);

        //     return redirect()->back()->with('success', 'added to cart successfully');
        // }
        // print_r(session('cart'));


        // if(isset($cart[$id])){
        //     $cart[$id]['quantity']
        // }

        // $foodid = $request->foodid;



        $cart = session()->get('cart'); // cart session 

        // Sorting and  Change the Collection array to Normal Array
        $additionalArray = collect($request->additionalarray)->sort()->values()->toArray(); //$request->addditionalarray is normal array.'collect()' so change the collection array and 'sort(),values()' sorting value and index and then 'reverse()' reverse to normalArray

        /////Replace AdditionArray for Same Additional
        // $additionalArrayOg =  collect($request->additionalarray)->sort()->values();
        // $additionalArrayMap = $additionalArrayOg->map(function ($item) {
        //     return $item;
        // });

        //additionalarray id to Name (AddonDetailsName) 
        // dd($request->additionalarray);
        $array = collect($request->additionalarray)->sort()->values();
        $additionalName = $array->map(function ($item) {
            $addondetail = Addondetail::find($item);
            return $addondetail->addondetail_name;
        });

        $additionalArrayMap =  $array->map(function ($item) {
            $addondetail = Addondetail::find($item);
            return $addondetail->id;
        });
        // dd($additionalArrayMap);

        //additionalarray id to Price (AddonDetailsPrice) 
        $additionArrayPrice = collect($array->map(function ($item) {
            $a = Addondetail::find($item);
            return $a->addondetail_price;
        }));
        $additionPriceTotal = $additionArrayPrice->sum();
        ///

        $foodfilter = Menu::find($request->foodid);
        // dd($cart->sum('foodprice'));

        function datastore($request, $foodfilter, $additionalArray, $additionalName, $additionPriceTotal)
        {

            return [
                'foodid' => $request->foodid,
                'foodname' => $foodfilter->product_name,
                'foodprice' => $foodfilter->product_price,
                'foodimage' => $foodfilter->product_image,
                'additionalarray' => $additionalArray,
                'additionalname' => $additionalName,
                'additionprice' => $additionPriceTotal,
                'quantity'    =>  $request->quantity,
                'totalprice' => ($foodfilter->product_price + $additionPriceTotal) * $request->quantity
            ];

            // $request->session()->put('cart', $cart);
        }
        if (!$cart) {
            $cart = collect([datastore($request, $foodfilter, $additionalArray, $additionalName, $additionPriceTotal)]);
            // $cart = collect([
            //     [
            //         'foodid' => $request->foodid,
            //         'foodname' => $foodfilter->product_name,
            //         'foodprice' => $foodfilter->product_price,
            //         'foodimage' => $foodfilter->product_image,
            //         'additionalarray' => $additionalArray,
            //         'additionalname' => $additionalName,
            //         'additionprice' => $additionPriceTotal,
            //         'quantity'    =>  $request->quantity,
            //         'totalprice' => ($foodfilter->product_price + $additionPriceTotal) * $request->quantity
            //     ]
            // ]);


            $request->session()->put('cart', $cart);
            return redirect()->back();
        } else {

            // dd($cart->sum('additionprice'));
            // dd($request->session()->get('cart'));
            if (!$cart->contains('foodid', $request->foodid)) {
                // dd($request->foodid);
                $cart->push(datastore($request, $foodfilter, $additionalArray, $additionalName, $additionPriceTotal));
                // $cart->push([
                //     'foodid' => $request->foodid,
                //     'foodname' => $foodfilter->product_name,
                //     'foodprice' => $foodfilter->product_price,
                //     'foodimage' => $foodfilter->product_image,
                //     'additionalarray' => $additionalArray,
                //     'additionalname' => $additionalName,
                //     'additionprice' => $additionPriceTotal,
                //     'quantity'    =>  $request->quantity,
                //     'totalprice' => ($foodfilter->product_price + $additionPriceTotal) * $request->quantity

                // ]);
            } elseif ($cart->contains('foodid', $request->foodid) && $cart->contains('additionalarray', $additionalArray)) {
                $filtered = $request->session()->get('cart')->filter(function ($el) {
                    return $el['additionalarray'] == [];
                });
                // dd($filtered);
                // dd($filtered->contains('foodid', 4));
                if (!$filtered->contains('foodid', $request->foodid) && $request->additionalarray == []) {
                    // dd($filtered, $request->foodid);

                    $cart->push(datastore($request, $foodfilter, $additionalArray, $additionalName, $additionPriceTotal));
                } else {
                    // dd($filtered);
                    // dd('inside');
                    foreach ($cart as $index => $carts) {
                        if ($carts['foodid'] == $request->foodid && $carts['additionalarray'] == $additionalArray) {
                            // dd($carts['additionalarray'], $additionalArray);
                            // dd($carts['foodid'], $carts['additionalarray']);

                            $foodcartindex = $index;    //Array index of FoodID
                            $beforquantity = $carts['quantity']; //currectQuantity
                            $foodprice = $carts['foodprice']; //currectFoodprice
                            $additionprice = $carts['additionprice']; //currectAdditionprice
                            $afterquantity = $beforquantity + $request->quantity; //UpdateQuantity


                            if (isset($request->index)) {
                                // dd($index, $request->index, $carts['additionalarray'], $cart[$index]['additionalarray']);
                                // dd('d');
                                $afterquantity =  $request->quantity; //UpdateQuantity

                                if ($index !== $request->index &&  $carts['additionalarray'] == $cart[$index]['additionalarray']) {
                                    // dd($index, $request->index, $carts['additionalarray'], $cart[$index]['additionalarray']);
                                    // dd($carts['quantity']);
                                    // dd($foodcartindex);
                                    // dd('s');
                                    if ($request->index == 0) {

                                        $cart->forget($index);
                                        $foodcartindex = $request->index;
                                        $index = $request->index;
                                        // $additionalArray = $additionalArray;
                                    } else {

                                        $cart->forget($request->index);
                                        // $cart->sort()->values();
                                        // dd($cart->forget($request->index)->values());
                                    }

                                    // $request->session()->put('cart', $cart);

                                    $afterquantity = $carts['quantity'] + $request->quantity;
                                }
                                // dd($cart);
                                // break;
                            }
                            $aftertotalprice = ($foodprice + $additionprice) *  $afterquantity; //UpdateTotalprice
                            // dd($afterquantity);
                            //Replace with update data
                            // dd($cart[$foodcartindex]['additionalarray'], $request->additionalarray);
                            $cart = $cart->replaceRecursive([$foodcartindex => ['quantity' => $afterquantity]]);
                            $cart = $cart->replaceRecursive([$foodcartindex => ['additionprice' => $additionPriceTotal]]);
                            $cart = $cart->replaceRecursive([$foodcartindex => ['additionalarray' => collect($additionalArrayMap)]]);
                            $cart = $cart->replaceRecursive([$foodcartindex => ['additionalarray' => $cart[$index]['additionalarray']->toArray()]]);

                            $cart = $cart->replaceRecursive([$foodcartindex => ['additionalname' => $additionalName]]);
                            $cart = $cart->replaceRecursive([$foodcartindex => ['totalprice' => $aftertotalprice]]);
                            $request->session()->put('cart', $cart->values());
                            return redirect()->back();
                        }
                    }
                }
            } elseif ($cart->contains('foodid', $request->foodid) && !$cart->contains('additionalarray', $additionalArray)) {
                // dd('su');
                // dd('side');
                // dd($additionalArrayMap);
                if (isset($request->index)) {
                    $cartindex = $cart[$request->index];
                    // dd($index, $request->index, $carts['additionalarray']);

                    $foodcartindex = $request->index;    //Array index of FoodID
                    $afterquantity =  $request->quantity; //UpdateQuantity
                    $aftertotalprice = ($cartindex['foodprice'] + $additionPriceTotal) *  $afterquantity; //UpdateTotalprice //notice:  $additionprice to change $additionPriceTotal
                    // dd('d');
                    //Replace with update data
                    // dd($afterquantity, $carts['foodprice'], $additionPriceTotal, $aftertotalprice); 
                    $cart = $cart->replaceRecursive([$foodcartindex => ['quantity' => $afterquantity]]);
                    $cart = $cart->replaceRecursive([$foodcartindex => ['additionprice' => $additionPriceTotal]]);
                    $cart = $cart->replaceRecursive([$foodcartindex => ['additionalarray' => collect($additionalArrayMap)]]);
                    $cart = $cart->replaceRecursive([$foodcartindex => ['additionalarray' => $cart[$request->index]['additionalarray']->toArray()]]);
                    $cart = $cart->replaceRecursive([$foodcartindex => ['additionalname' => $additionalName]]);
                    $cart = $cart->replaceRecursive([$foodcartindex => ['totalprice' => $aftertotalprice]]);
                } elseif (!$cart->contains('additionalarray', $additionalArray)) {
                    // dd('dd');
                    $cart->push(datastore($request, $foodfilter, $additionalArray, $additionalName, $additionPriceTotal));
                }

                $request->session()->put('cart', $cart);
            }
            // dd($cart);
        }
        // $request->session()->regenerate();
        // $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->back();

        // session(['cart' => $request->session('cart')->all()]);
    }


    public function update(Request $request)
    {
        $request->session()->put('cart', collect($request->cart));
        return redirect()->back();
    }

    public function remove(Request $request)
    {

        // dd($request->index);
        $cart = session()->get('cart');
        // dd($cart->count() == 0);

        $cart->forget($request->index);
        if ($cart->count() == 0) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } else {
            $request->session()->put('cart', $cart->values());
        }

        return redirect()->back();
    }

    public function order(Request $request)
    {
        $cart = collect($request->cart);
        $totalquantity = $cart->sum('quantity');
        $totalamount = $cart->sum('totalprice');
        Order::boot();
        Orderdetail::boot();

        $id = Order::create([

            'TotalQuantity' => $totalquantity,
            'TotalAmount' => $totalamount,

        ]);
        // dd($id['id']);

        foreach ($cart as $index => $carts) {

            Orderdetail::create([
                'orderdetails_quantity' => $carts['quantity'],
                'orderdetails_totalprice' => $carts['totalprice'],
                'order_id' => $id['id'],
                'menu_id' => $carts['foodid']
            ]);
        }

        // // return redirect()->back();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return redirect()->route('menu.orderdisplay', ['id' => 10]);

        return response()->json([
            'success' => true,
            'id' => $id['id']

        ]);
        //     ->with(('success'));
    }
    public function checkout()
    {
        $cart = session()->get('cart'); // cart session 

        if (!$cart) {
            return inertia(
                'Index/EmptyCartForCheckout',
            );
        } else {
            return inertia(
                'Index/Checkout',
                [
                    'cart' =>  $cart,
                ],

            );
        }
    }
    public function checkoutupdate(Request $request)
    {
        // dd('au');
        $cart = session()->get('cart');

        $foodcartindex = $request->index;    //Array index of FoodID
        if ($request->action == 'add') {
            // dd('addd');
            $afterquantity =  $cart[$foodcartindex]['quantity'] + 1; //UpdateQuantity



        } elseif ($request->action == 'reduce') {
            // dd('remove');
            $afterquantity =  $cart[$foodcartindex]['quantity'] - 1; //UpdateQuantity

            if ($afterquantity <= 0) {
                $afterquantity =  0;
                return response()->json([
                    'success' => true,
                    'totalprice' => ($cart[$foodcartindex]['foodprice'] + $cart[$foodcartindex]['additionprice'])
                ]);
            }
        }
        // elseif ($request->action == 'remove') {
        //     dd('remove');
        // }

        $aftertotalprice = ($cart[$foodcartindex]['foodprice'] + $cart[$foodcartindex]['additionprice']) *  $afterquantity; //UpdateTotalprice //notice:  $additionprice to change $additionPriceTotal
        $cart = $cart->replaceRecursive([$foodcartindex => ['quantity' => $afterquantity]]);
        $cart = $cart->replaceRecursive([$foodcartindex => ['totalprice' => $aftertotalprice]]);

        $request->session()->put('cart', $cart);
        // dd($cart);
        // return redirect()->back();
        return response()->json([
            'success' => true,
            'totalprice' => $aftertotalprice

        ]);
        // return redirect()->intended();
    }
    public function orderdisplay($id)
    {
        // dd(Orderdetail::where('order_id', '=', $id));
        return inertia(
            'Index/Order',
            [
                'orders' =>  Order::find($id),
                'orderdetails' => Orderdetail::where('order_id', '=', $id)->get(),
                'menu' => Menu::all()
            ],

        );
    }
}

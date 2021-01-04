<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $quantity = 1)
    {

        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty'] += $quantity;
        $storedItem['price'] = $item->price * $storedItem['qty'];

        $this->items[$id] = $storedItem;
        $this->totalQty += $quantity;
        $this->totalPrice += $item->price * $storedItem['qty'];

    }

    public function reduce($id, $quantity = 1){
        $this->items[$id]['qty'] -= $quantity;
        $this->items[$id]['price'] -= ($quantity * $this->items[$id]['item']['price']);
        $this->totalQty -= $quantity;
        $this->totalPrice -= ($quantity * $this->items[$id]['item']['price']);

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }

    }
}

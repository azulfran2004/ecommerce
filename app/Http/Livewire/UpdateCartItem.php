<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateCartItem extends Component
{
    public $rowId;
    public $qty, $quantity;
    public function mount()
    {
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;
        $this->quantity = qty_available($item->id);
    }
    public function decrement()
    {
        $this->qty--;
        Cart::update($this->rowId, $this->qty);
    }
    public function increment()
    {
        $this->qty++;
        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.update-cart-item');
        $this->emit('render');
    }
}

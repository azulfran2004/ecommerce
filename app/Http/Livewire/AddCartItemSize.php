<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddCartItemSize extends Component
{
    public $product;
    public $sizes;
    public $size_id = '';
    public $color_id = '';
    public $colors;
    public $qty = 1;
    public $quantity = 0;
    public $options = [];
    public function mount()
    {
        $this->sizes = $this->product->sizes;
        $this->colors = $this->product->colors;

        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }
    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
        
    }
    public function decrement()
    {
        $this->qty--;
    }
    public function increment()
    {
        $this->qty++;
    }
    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
        
    }
    public function addItem()
    {
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options,
        ]);
        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render');
    }
}

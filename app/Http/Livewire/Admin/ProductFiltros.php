<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\WithPagination;
use App\Models\Color;
use App\Models\Size;
use App\Models\Brand;

class ProductFiltros extends Component
{
    use WithPagination;

    public $search;
    public $numeroColumnas = 11;
    public $numeroProductos = 10;
    public $mostrarFiltros = false;
    public $subcategoria="%%";
    public $marca="%%";
    public $ordenar='id'  ;

    public function render()
    {
        $ordenar = $this->ordenar;
        $y = $this->numeroProductos;
        $products = Product::where('name', 'LIKE', "%{$this->search}%")
            ->where('subcategory_id', 'LIKE', "{$this->subcategoria}")
            ->where('brand_id', 'LIKE', "{$this->marca}")
            ->orderBy($ordenar)
            ->paginate($y);
        $columnas = $this->numeroColumnas;
        $categorias = Category::all();
        $subcategorias = Subcategory::all();
        $colors = Color::all();
        $brands = Brand::all();

        return view('livewire.admin.filter-products', compact('products',  'columnas',  'categorias', 'subcategorias', 'colors', 'brands'))
            ->layout('layouts.admin');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingSubcategoria()
    {
        $this->resetPage();
    }
    public function updatingmarca()
    {
        $this->resetPage();
    }

    public function updatingOrdenar()
    {
        $this->resetPage();
    }
   
    public function ordenarpornombre()
    {
        $this->ordenar = 'name';
    }
    public function ordenarporprecio()
    {
        $this->ordenar = 'price';
    }
    public function ordenarporfecha()
    {
        $this->ordenar = 'created_at';
    }
    public function ordenarporstock()
    {
        $this->ordenar = 'quantity';
    }



    public function toggleFiltros()
    {
        $this->mostrarFiltros = !$this->mostrarFiltros;
    }
}

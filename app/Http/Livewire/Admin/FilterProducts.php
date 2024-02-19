<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Sortable;

class FilterProducts extends Component
{
    use WithPagination;

    public $search;
    public $numeroColumnas = 1;
    public $numeroProductos = 1;
    public $mostrarFiltros = false; 

    public function render()
    {
        $y = $this->numeroProductos;
        $products = Product::where('name', 'LIKE', "%{$this->search}%")->paginate($y);
        $columnas = $this->numeroColumnas;
        $headerNames = ['Nombre', 'Categoría', 'Estado', 'Precio', 'Editar', 'Subcategoría', 'Marca', 'Fecha de creación', 'Color', 'Talla', 'Stock'];

        return view('livewire.admin.filter-products', compact('products', 'headerNames', 'columnas',))
            ->layout('layouts.admin');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    

    public function toggleFiltros()
    {
        $this->mostrarFiltros = !$this->mostrarFiltros;
    }
}

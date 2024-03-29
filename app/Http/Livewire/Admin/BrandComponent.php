<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Brand;

class BrandComponent extends Component
{
    public $brands, $brand;
    protected $listeners = ['delete'];
    public $createForm = [
        'name' => null
    ];
    public $editForm = [
        'open' => false,
        'name' => null
    ];
    public $rules = [
        'createForm.name' => 'required'
    ];
    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre'
    ];


    public function render()
    {
        return view('livewire.admin.brand-component')->layout('layouts.admin');;
    }
    public function getBrands()
    {
        $this->brands = Brand::all();
    }
    public function mount()
    {
        $this->getBrands();
    }
    public function save()
    {
        $this->validate();
        Brand::create($this->createForm);
        $this->reset('createForm');
        $this->getBrands();
    }
    public function edit(Brand $brand)
    {
        $this->brand = $brand;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $brand->name;
    }
    public function update()
    {
        $this->validate([
            'editForm.name' => 'required'
        ]);
        $this->brand->update($this->editForm);
        $this->reset('editForm');
        $this->getBrands();
    }
    public function delete(Brand $brand)
    {
        $brand->delete();
        $this->getBrands();
    }
}

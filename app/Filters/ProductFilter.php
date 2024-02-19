<?php

namespace App\Filters;

use App\Rules\SortableColumn;
use App\Sortable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductFilter extends QueryFilter
{
    public function filterRules(): array
    {
        return [
            'search' => 'filled',
            'order' => ['filled', new SortableColumn([
                'name', 'category', 'status', 'price', 'subcategory', 'brand', 'created_at', 'color', 'size', 'stock'
            ])],
            'category' => 'filled',
            'subcategory' => 'filled',
            'brand' => 'filled',
            'color' => 'filled',
            'size' => 'filled',
            'stock' => 'filled',
            'price' => 'filled',
            'created_at' => 'filled',
            'status' => 'filled',
        ];
    }

    public function search($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%");
    }

    public function category($query, $category)
    {
        return $query->where('category', $category);
    }

    public function subcategory($query, $subcategory)
    {
        return $query->where('subcategory', $subcategory);
    }

    public function brand($query, $brand)
    {
        return $query->where('brand', $brand);
    }

    public function color($query, $color)
    {
        return $query->where('color', $color);
    }

    public function size($query, $size)
    {
        return $query->where('size', $size);
    }

    public function stock($query, $stock)
    {
        return $query->where('stock', $stock);
    }

    public function price($query, $price)
    {
        return $query->where('price', $price);
    }

    public function createdAt($query, $createdAt)
    {
        return $query->whereDate('created_at', Carbon::parse($createdAt)->format('Y-m-d'));
    }

    public function status($query, $status)
    {
        return $query->where('status', $status);
    }

    public function order($query, $value)
    {
        [$column, $direction] = Sortable::info($value);

        return $query->orderBy($column, $direction);
    }
}

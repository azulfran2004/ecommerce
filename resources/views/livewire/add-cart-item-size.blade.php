<div>
    <div>
        <p class="text-xl text-gray-700">Talla:</p>
        <select wire:model="size_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una talla</option>
            @foreach ($sizes as $size)
            <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>
    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible:</span> {{ $product->stock }}
        @if($quantity)
        {{ $quantity }}
        @else
        {{ $product->stock }}
        @endif
    </p>
    <div class="flex mt-2">
        <p class="text-xl text-gray-700">Color:</p>
        <select class="form-control w-full">
            <option value="" selected disabled>Seleccione un color</option>
            @foreach ($colors as $color)
            <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
            @endforeach
        </select>
        <div class="flex-1">
            <x-button x-bind:disabled="$wire.qty > $wire.quantity" wire:click="addItem" wire:loading.attr="disabled" wire:target="addItem" class="w-full" color="orange">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>
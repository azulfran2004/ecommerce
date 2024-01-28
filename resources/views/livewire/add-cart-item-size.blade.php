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
    <div class="mt-2">
        <p class="text-xl text-gray-700">Color:</p>
        <select class="form-control w-full">
            <option value="" selected disabled>Seleccione un color</option>
            @foreach ($colors as $color)
            <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
            @endforeach
        </select>
        <div class="flex-1">
            <x-button x-bind:disabled="!$wire.quantity" wire:click="addItem" wire:loading.attr="disabled" wire:target="addItem" class="w-full" color="orange">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>
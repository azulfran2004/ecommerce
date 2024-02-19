<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos
            </h2>

        </div>
    </x-slot>
















    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <x-table-responsive>
                        <div class="px-6 py-4">
                            <label for="numeroColumnas" class="mr-2">Numero de columnas mostradas</label>
                            <select id="numeroColumnas" class="form-select w-16" wire:model="numeroColumnas">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </div>
                        <div class="px-6 py-4">
                            <label for="numeroProductos" class="mr-2">Numero de productos por pagina</label>
                            <select id="numeroProductos" class="form-select w-16" wire:model="numeroProductos">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </div>


                        <!-- Agregamos un botón para mostrar/ocultar el formulario -->
                        <button class="px-4 py-2 bg-blue-500 text-white rounded" wire:click="toggleFiltros">Mostrar Filtros</button>

                        <!-- Formulario de filtros (se muestra/oculta con clases de Tailwind) -->
                        <div class="{{ $mostrarFiltros ? 'block' : 'hidden' }}">
                            <!-- Aquí colocas tus elementos de filtro -->
                            <div class="px-6 py-4">
                                <!-- Agrega tus campos de filtro aquí -->
                                <!-- Ejemplo: -->
                                <label for="filtroCategoria" class="mr-2">Categoría:</label>
                                <select id="filtroCategoria" class="form-select w-16" wire:model="filtroCategoria">
                                    <!-- Opciones de categoría -->
                                </select>
                            </div>


                            <div class="px-6 py-4">
                                <button class="px-4 py-2 bg-green-500 text-white rounded" wire:click="aplicarFiltros">Aplicar Filtros</button>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <x-jet-input dusk="buscador" class="w-full" wire:model="search" type="text" placeholder="Introduzca el nombre del producto a buscar" />
                        </div>
                        @if($products->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @for ($i = 0; $i < $numeroColumnas; $i++) <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $headerNames[$i] }}
                                        </th>
                                        @endfor
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($products as $product)
                                <tr>
                                    <?php $x = 0; ?>
                                    @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 object-cover">
                                                <img class="h-10 w-10 rounded-full" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $product->name }}
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        @endif
                                        <?php $x++; ?>
                                        @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                                            </td>

                                            @endif
                                            <?php $x++; ?>
                                            @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
}}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                                    {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                                                </span>
                                                </td>

                                                @endif
                                                <?php $x++; ?>
                                                @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $product->price }} &euro;
                                                    </td>

                                                    @endif
                                                    <?php $x++ ?>
                                                    @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a dusk="editar" href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                                        </td>

                                                        @endif
                                                        <?php $x++ ?>
                                                        @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $product->subcategory->name }}
                                                            </td>

                                                            @endif
                                                            <?php $x++ ?>
                                                            @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $product->brand->name }}
                                                                </td>

                                                                @endif
                                                                <?php $x++ ?>
                                                                @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{ $product->created_at }}
                                                                    </td>

                                                                    @endif
                                                                    <?php $x++ ?>
                                                                    @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        {{ $product->color }}
                                                                        </td>

                                                                        @endif
                                                                        <?php $x++ ?>
                                                                        @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                            {{ $product->size }}
                                                                            </td>

                                                                            @endif
                                                                            <?php $x++ ?>
                                                                            @if ($x < $numeroColumnas) <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                                {{ $product->stock }}
                                                                                </td>
                                                                                @endif
                                                                                <?php $x++ ?>
                                </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                        @else
                        <div class="px-6 py-4">
                            No existen productos coincidentes
                        </div>
                        @endif
                        @if($products->hasPages())
                        <div class="px-6 py-4">
                            {{ $products->links() }}
                        </div>
                        @endif
                    </x-table-responsive>
                </div>
            </div>
        </div>
    </div>
</div>
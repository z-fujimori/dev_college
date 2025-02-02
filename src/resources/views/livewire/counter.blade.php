<div>
    {{-- Success is as dangerous as failure. --}}

    <h3>{{ $count }}</h3>

    <div class="m-10">
        <button class="m-1 p-3 bg-gray-400 raunded-lg" wire:click="increment" wire:keydown.up="increment">+</button>
        <button class="m-1 p-3 bg-gray-400 raunded-lg" wire:click="decrement" wire:keydown.down="decrement">-</button>
    </div>

</div>

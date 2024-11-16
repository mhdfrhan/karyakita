@props(['name', 'label', 'options', 'model'])

<div x-data="{
    options: {{ Js::from($options) }},
    isOpen: false,
    selectedOption: null,
    setSelectedOption(option) {
        this.selectedOption = option;
        this.isOpen = false;
        $wire.set('{{ $model }}', option.value);
    }
}"
class="w-full max-w-xs flex flex-col gap-1 mt-1"
x-on:keydown.esc.window="isOpen = false">
    <div class="relative">
        <button type="button"
            role="combobox"
            class="w-full bg-transparent border border-neutral-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 flex justify-between py-3 px-4"
            aria-haspopup="listbox"
            aria-controls="dropdown-list"
            x-on:click="isOpen = !isOpen">
            <span x-text="selectedOption ? selectedOption.label : '{{ $label }}'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Gunakan wire:model saja tanpa x-model untuk menghindari konflik -->
        <input type="hidden" name="{{ $name }}" wire:model="{{ $model }}" />

        <ul x-show="isOpen"
            id="dropdown-list"
            class="absolute z-10 left-0 top-14 flex max-h-44 w-full flex-col overflow-hidden overflow-y-auto border-neutral-300 bg-neutral-50 py-1.5 rounded-md border"
            role="listbox"
            aria-label="dropdown list"
            x-on:click.outside="isOpen = false">
            <template x-for="(item, index) in options" :key="item.value">
                <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900"
                    role="option"
                    x-on:click="setSelectedOption(item)">
                    <span x-text="item.label"></span>
                </li>
            </template>
        </ul>
    </div>
</div>
<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="mb-8 flex flex-wrap items-center justify-between gap-3 gap-y-6">
                <div class="flex flex-wrap items-center gap-3">
                    @php
                        $kategori = [
                            'Jasa Online',
                            'Jasa Offline',
                        ];
                    @endphp
                    @foreach ($kategori as $k)
                        <a href=""
                            class="bg-neutral-200/50 py-2 px-4 rounded-full text-neutral-500 hover:bg-neutral-200 duration-300 text-sm">
                            <span>{{ $k }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center gap-3">
                    <div class="inline-flex items-center gap-2">
                        <div x-data="{
                            options: [{
                                    value: 'Teratas',
                                    label: 'Teratas',
                                },
                                {
                                    value: 'Terbaru',
                                    label: 'Terbaru',
                                },
                                {
                                    value: 'Termurah',
                                    label: 'Termurah',
                                }
                            ],
                            isOpen: false,
                            openedWithKeyboard: false,
                            selectedOption: null,
                            setSelectedOption(option) {
                                this.selectedOption = option
                                this.isOpen = false
                                this.openedWithKeyboard = false
                                this.$refs.hiddenTextField.value = option.value
                            },
                            highlightFirstMatchingOption(pressedKey) {
                                const option = this.options.find((item) =>
                                    item.label.toLowerCase().startsWith(pressedKey.toLowerCase()),
                                )
                                if (option) {
                                    const index = this.options.indexOf(option)
                                    const allOptions = document.querySelectorAll('.combobox-option')
                                    if (allOptions[index]) {
                                        allOptions[index].focus()
                                    }
                                }
                            },
                        }" class="w-full max-w-xs flex flex-col gap-1"
                            x-on:keydown="highlightFirstMatchingOption($event.key)"
                            x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                            <div class="relative">

                                <!-- trigger button  -->
                                <button type="button" role="combobox"
                                    class="text-sm inline-flex items-center gap-1 text-neutral-500"
                                    aria-haspopup="listbox" aria-controls="industriesList"
                                    x-on:click="isOpen = ! isOpen" x-on:keydown.down.prevent="openedWithKeyboard = true"
                                    x-on:keydown.enter.prevent="openedWithKeyboard = true"
                                    x-on:keydown.space.prevent="openedWithKeyboard = true"
                                    x-bind:aria-label="selectedOption ? selectedOption.value : 'Urutkan sesuai'"
                                    x-bind:aria-expanded="isOpen || openedWithKeyboard">
                                    <span class="text-sm font-normal"
                                        x-text="selectedOption ? selectedOption.value : 'Urutkan sesuai'"></span>
                                    <!-- Chevron  -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-5">
                                        <path fill-rule="evenodd"
                                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- hidden input to grab the selected value  -->
                                <input id="industry" name="industry" type="text" x-ref="hiddenTextField" hidden />
                                <ul x-cloak x-show="isOpen || openedWithKeyboard" id="industriesList"
                                    class="absolute z-10 left-0 top-11 flex max-h-44 w-40 flex-col overflow-hidden overflow-y-auto p-2 border bg-white border-neutral-200 shadow-lg shadow-neutral-200/40 rounded-xl"
                                    role="listbox" aria-label="industries list"
                                    x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                                    x-on:keydown.down.prevent="$focus.wrap().next()"
                                    x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition
                                    x-trap="openedWithKeyboard">
                                    <template x-for="(item, index) in options" x-bind:key="item.value">
                                        <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-none rounded-lg"
                                            role="option" x-on:click="setSelectedOption(item)"
                                            x-on:keydown.enter="setSelectedOption(item)" x-bind:id="'option-' + index"
                                            tabindex="0">
                                            <!-- Label  -->
                                            <span x-bind:class="selectedOption == item ? 'font-bold' : null"
                                                x-text="item.label"></span>
                                            <!-- Screen reader 'selected' indicator  -->
                                            <span class="sr-only"
                                                x-text="selectedOption == item ? 'selected' : null"></span>
                                            <!-- Checkmark  -->
                                            <svg class="size-4" x-cloak x-show="selectedOption == item"
                                                xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                                                </path>
                                            </svg>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="inline-flex items-center gap-2">
                        {{-- grid --}}
                        <button>
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                                </path>
                            </svg>
                        </button>

                        {{-- row --}}
                        <button>
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M208,136H48a16,16,0,0,0-16,16v40a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V152A16,16,0,0,0,208,136Zm0,56H48V152H208v40Zm0-144H48A16,16,0,0,0,32,64v40a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V64A16,16,0,0,0,208,48Zm0,56H48V64H208v40Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @for ($i = 0; $i < 9; $i++)
                    <x-product-card
                        image="https://cdn.dribbble.com/userupload/16547122/file/original-517193b05b0305a27dfc2c4c8e235eaa.png?resize=1504x1128"
                        title="Freelance Marketplace App" rating="4.8 (200)" price="250000" category="Aplikasi"
                        categorySlug="aplikasi" slug="freelance-marketplace-app" />
                @endfor
            </div>

            {{-- pagination --}}

        </div>
    </section>
</x-main-layout>

@if (session('success'))
    <div class="bg-green-200 border border-green-400 overflow-hidden shadow-sm sm:rounded-lg fixed top-4 right-4 z-[999]"
        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transform transition duration-300" x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100" x-transition:leave="transform transition duration-300"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0">
        <div class="py-3 flex items-center gap-2 px-6 text-green-800">
            <svg class="size-5 fill-green-800" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM80,108a12,12,0,1,1,12,12A12,12,0,0,1,80,108Zm104,0a8,8,0,0,1-8,8H152a8,8,0,0,1,0-16h24A8,8,0,0,1,184,108Zm-9.08,48c-10.29,17.79-27.39,28-46.92,28s-36.63-10.2-46.93-28a8,8,0,1,1,13.86-8c7.46,12.91,19.2,20,33.07,20s25.61-7.1,33.08-20a8,8,0,1,1,13.84,8Z">
                </path>
            </svg>

            {{ session('success') }}
        </div>
    </div>
@elseif (session('error'))
    <div class="bg-red-200 border border-red-400 overflow-hidden shadow-sm sm:rounded-lg fixed top-4 right-4 z-[999]"
        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transform transition duration-300" x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100" x-transition:leave="transform transition duration-300"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0">
        <div class="py-3 flex items-center gap-2 px-6 text-red-800">
            <svg class="size-5 fill-red-800" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-56a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h80A8,8,0,0,1,176,160ZM80,108a12,12,0,1,1,12,12A12,12,0,0,1,80,108Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,176,108Z">
                </path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
@endif

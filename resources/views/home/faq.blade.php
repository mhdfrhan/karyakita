<x-main-layout>
    @push('styles')
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    @endpush
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="max-w-2xl mb-10 lg:mb-14">
                <h1 class="text-3xl lg:text-4xl font-semibold">Pertanyaan yang Sering Ditanyakan</h1>
                <p class="text-neutral-500 mt-4">Berikut adalah beberapa pertanyaan yang sering ditanyakan oleh beberapa
                    orang tentang tata cara berbelanja di website KaryaKita</p>
            </div>
            <div class="relative flex flex-wrap lg:-mx-6 divide-x divide-neutral-200/60">
                <div class="w-full lg:w-1/2 lg:px-6 sticky top-0">
                    <h1 class="text-3xl lg:text-4xl font-semibold">Butuh Bantuan?</h1>
                    <p class="text-neutral-500 mt-6">
                        Jika Anda memiliki masalah atau pertanyaan yang memerlukan bantuan segera, Anda dapat mengklik
                        tombol di bawah ini untuk menghubungi kami.
                    </p>
                    <div class="mt-6">
                        <a href="" class="block text-center">
                            <x-border-button class="w-full !border-neutral-200 inline-flex items-center justify-center">
                                <svg class="size-5 mr-2 fill-neutral-600" xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                                    </path>
                                </svg>
                                Kontak Kami
                            </x-border-button>
                        </a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 lg:px-6">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-semibold mb-6">Informasi Belanja</h1>
                        
                        <div class="flex w-full flex-col gap-4 text-neutral-600">
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What browsers are supported?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-black">documentation</a> for additional information.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   How can I contact customer support?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-black">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                   </div>
                               </div>
                           </div>
                           <div x-data="{ isExpanded: false }" class="divide-y overflow-hidden rounded-xl" :class="isExpanded ? 'bg-indigo-500 text-white divide-indigo-500'  : 'bg-transparent text-neutral-600 divide-transparent'">
                               <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-2 p-4 text-left" aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'bg-indigo-500 text-white font-medium'  : 'bg-neutral-200/40 hover:bg-neutral-200/70 text-neutral-600'" :aria-expanded="isExpanded ? 'true' : 'false'">
                                   What is the refund policy?
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                   </svg>
                               </button>
                               <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree"  x-collapse>
                                   <div class="p-4 pt-0 text-sm sm:text-base text-pretty" :class="isExpanded ? 'bg-indigo-500 text-neutral-50 border-indigo-500' : ' text-neutral-500'">
                                       Please refer to our <a href="#" class="underline underline-offset-2 text-black">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>

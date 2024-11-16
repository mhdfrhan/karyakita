@props(['image', 'created_at', 'categorySlug', 'categoryName', 'slug', 'title', 'excerpt'])

<div class="w-full sm:w-1/2 lg:w-1/3 p-4">
   <div class="border rounded-2xl">
       <div class="pb-2">
           <img src="{{ asset($image) }}" class="rounded-2xl" alt="">
       </div>
       <div class="p-4 pt-2">
           <p class="mb-1 text-neutral-500 text-sm">
               {{ date('j F Y', strtotime($created_at)) }}
           </p>
           <a href=""
               class="hover:text-indigo-500 duration-300 block">
               <h3 class="text-xl font-semibold font-plusjakartasans line-clamp-2 capitalize">
                   {{ $title }}</h3>
           </a>
           <p class="line-clamp-3 mt-1 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
               {{ $excerpt }}
           </p>
       </div>
   </div>
</div>

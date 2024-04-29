<div class="w-full px-4 md:p-0">
    <div class="bg-white dark:bg-neutral-900 text-black dark:text-white rounded-lg shadow-md border dark:border-neutral-800 p-4 flex flex-col gap-4">
        @isset($title)
            <h1 class="text-xl md:text-2xl lg:text-3xl font-semibold">{{ $title }}</h1>
        @endisset

        {{ $slot }}
    </div>
</div>

<div id="header-mobile" class="sticky top-0 left-0 w-full p-4 bg-white/70 dark:bg-black/70 flex md:hidden justify-between items-center z-50 transition-all duration-300">
    <button class="sidebar-toggle-button">
        <x-heroicon-m-bars-3 class="w-6 h-6"/>
    </button>
    <p class="text-2xl font-bold">Muscle MAX 💪🏼</p>
    <button>
        <div class="w-5 h-5">

        </div>
    </button>
</div>

@pushOnce("page.scripts")
    <script>
        window.addEventListener("scroll", (event) => {
            let scroll = this.scrollY;
            let header = $('#header-mobile');

            console.log(scroll);

            if (scroll > 50) {
                header.addClass('shadow-md backdrop-blur-lg');
            } else {
                header.removeClass('shadow-md backdrop-blur-lg')
            }
        });
    </script>
@endpushonce

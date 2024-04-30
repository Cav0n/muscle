<div id="{{ $id ?? ('modal-'.Str::rand(10))  }}" class="modal-container fixed inset-0 overflow-y-auto bg-black/50 backdrop-blur-sm flex flex-col justify-center items-center p-4 z-[51] transition-all duration-500 pointer-events-none opacity-0 hidden">
    <div class="modal-inner max-w-xl w-full p-4 bg-white rounded-lg shadow flex flex-col gap-4">
        @isset($title)
            <p class="text-2xl md:text-4xl font-semibold">{{ $title }}</p>
        @endisset

        @yield("modal.content")
    </div>
</div>

@pushOnce('page.scripts')
    <script type="module">
        $(document).ready(function () {
            $('.modal-container').removeClass('hidden');
        });

        $('.modal-container').on('click', function () {
            if ($(event.target).hasClass('modal-container')) {
                toggleModal($(this).attr('id'));
            }
        });

        function toggleModal(id)
        {
            $('#'+id).toggleClass('pointer-events-none opacity-0')
        }

        $('.modal-button').on('click', function () {
            toggleModal($(this).data('modal-id'));
        });
    </script>
@endpushonce

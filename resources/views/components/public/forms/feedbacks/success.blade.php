
@if(null !== session("success"))
    <div id="success-container" class="fixed -bottom-full left-0 right-0 p-4 flex items-center pointer-events-none z-[52] transition-all duration-500">
        <div class="max-w-xl mx-auto w-full">
            <div class="w-full p-4 bg-green-500/80 text-white backdrop-blur-sm rounded-lg shadow mb-4 text-center">
                <p>{{ session("success") }}</p>
            </div>
        </div>
    </div>

    @push('page.scripts')
        <script type="module">
            $(document).ready(function () {
                $('#success-container').toggleClass('-bottom-full bottom-0')

                setTimeout(() => { $('#success-container').toggleClass('-bottom-full bottom-0'); }, 4000);
            });
        </script>
    @endpush
@endif

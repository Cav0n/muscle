@if ($errors->any())
    <div id="errors-container" class="fixed -bottom-full left-0 right-0 p-4 flex items-center pointer-events-none z-[51] transition-all duration-500">
        <div class="max-w-xl mx-auto w-full">
            <div class="w-full p-4 bg-red-500/80 text-white backdrop-blur-sm rounded-lg shadow mb-4 text-center">
                @foreach ($errors->all() as $error)
                    {!! $error !!}
                @endforeach
            </div>
        </div>
    </div>

    @push('page.scripts')
        <script type="module">
            $(document).ready(function () {
                $('#errors-container').toggleClass('-bottom-full bottom-0')

                setTimeout(() => { $('#errors-container').toggleClass('-bottom-full bottom-0'); }, 4000);
            });
        </script>
    @endpush
@endif

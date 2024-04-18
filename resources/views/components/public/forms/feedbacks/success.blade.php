@if(null !== session("success"))
    <div class="w-full p-4 bg-green-500/20 rounded shadow mb-4">
        <p>{{ session("success") }}</p>
    </div>
@endif

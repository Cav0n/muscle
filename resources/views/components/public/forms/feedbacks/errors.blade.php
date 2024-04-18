@if ($errors->any())
    <div class="my-4 bg-red-500/30 border border-red-500/50 shadow-sm p-4 rounded">
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

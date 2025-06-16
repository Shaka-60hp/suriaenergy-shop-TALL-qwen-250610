@error($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@enderror

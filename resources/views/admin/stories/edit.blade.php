<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar História de Sucesso</h1>

        <form method="POST" action="{{ route('admin.stories.update', $story) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Animal</label>
                <select name="animal_id" class="w-full border rounded p-2" required>
                    <option value="">Selecione um Animal</option>
                    @foreach($animals as $animal)
                        <option value="{{ $animal->id }}" @selected($story->animal_id == $animal->id)>{{ $animal->name }}
                        </option>
                    @endforeach
                </select>
                @error('animal_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Título</label>
                <input name="title" value="{{ old('title', $story->title) }}" class="w-full border rounded p-2" required>
                @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Conteúdo</label>
                <textarea name="content" rows="5" class="w-full border rounded p-2"
                    required>{{ old('content', $story->content) }}</textarea>
                @error('content') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Foto</label>
                @if($story->photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $story->photo) }}" alt="{{ $story->title }}" class="h-32 rounded">
                        <p class="text-sm text-gray-600 mt-1">Foto atual</p>
                    </div>
                @endif
                <input type="file" name="photo" class="w-full border rounded p-2">
                @error('photo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Publicado</label>
                <input type="checkbox" name="published" value="1" @checked(old('published', $story->published))>
                <span class="text-sm text-gray-600">Publicar</span>
            </div>

            <div class="flex gap-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar História</button>
                <a href="{{ route('admin.stories.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>

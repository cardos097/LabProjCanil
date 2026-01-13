<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Animal</h1>

        <form method="POST" action="{{ route('admin.animals.update', $animal) }}" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Nome *</label>
                <input name="name" value="{{ old('name', $animal->name) }}" class="w-full border rounded p-2" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Espécie *</label>
                <select name="species" class="w-full border rounded p-2" required>
                    <option value="">Selecionar</option>
                    <option value="Cão" @selected(old('species', $animal->species) === 'Cão')>Cão</option>
                    <option value="Gato" @selected(old('species', $animal->species) === 'Gato')>Gato</option>
                    <option value="Outro" @selected(old('species', $animal->species) === 'Outro')>Outro</option>
                </select>
                @error('species') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Raça *</label>
                <input name="breed" value="{{ old('breed', $animal->breed) }}" class="w-full border rounded p-2" required>
                @error('breed') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Género *</label>
                <select name="gender" class="w-full border rounded p-2" required>
                    <option value="">Selecionar</option>
                    <option value="Masculino" @selected(old('gender', $animal->gender) === 'Masculino')>Masculino</option>
                    <option value="Feminino" @selected(old('gender', $animal->gender) === 'Feminino')>Feminino</option>
                </select>
                @error('gender') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Idade *</label>
                <select name="age" class="w-full border rounded p-2" required>
                    <option value="">Selecionar</option>
                    <option value="0" @selected(old('age', $animal->age) == '0')>&lt;1 ano</option>
                    @for($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" @selected(old('age', $animal->age) == $i)>{{ $i }} ano{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                @error('age') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Descrição</label>
                <textarea name="description" rows="5"
                    class="w-full border rounded p-2">{{ old('description', $animal->description) }}</textarea>
                @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Foto</label>
                @if($animal->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $animal->photo) }}" alt="Foto atual" class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-600">Foto atual</p>
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*" class="w-full border rounded p-2">
                <p class="text-sm text-gray-600">Deixe vazio para manter a foto atual</p>
                @error('photo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
                <a href="{{ route('admin.animals.index') }}" class="px-4 py-2 rounded border">Voltar</a>
            </div>
        </form>
    </div>
</x-app-layout>
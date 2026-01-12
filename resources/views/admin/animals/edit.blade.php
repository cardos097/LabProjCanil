<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Animal</h1>

        <form method="POST" action="{{ route('admin.animals.update', $animal) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Nome</label>
                <input name="name" value="{{ old('name', $animal->name) }}" class="w-full border rounded p-2" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Espécie</label>
                <input name="species" value="{{ old('species', $animal->species) }}" class="w-full border rounded p-2"
                    required>
                @error('species') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Raça</label>
                <input name="breed" value="{{ old('breed', $animal->breed) }}" class="w-full border rounded p-2">
                @error('breed') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Idade</label>
                    <input type="number" name="age" value="{{ old('age', $animal->age) }}"
                        class="w-full border rounded p-2" min="0" max="40">
                    @error('age') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold">Género</label>
                    <select name="gender" class="w-full border rounded p-2">
                        <option value="" @selected(old('gender', $animal->gender) === '')>Selecionar</option>
                        <option value="Masculino" @selected(old('gender', $animal->gender) === 'Masculino')>Masculino</option>
                        <option value="Feminino" @selected(old('gender', $animal->gender) === 'Feminino')>Feminino</option>
                    </select>
                    @error('gender') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block font-semibold">Descrição</label>
                <textarea name="description" rows="5"
                    class="w-full border rounded p-2">{{ old('description', $animal->description) }}</textarea>
                @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Status</label>
                <select name="status" class="w-full border rounded p-2" required>
                    <option value="Disponível" @selected(old('status', $animal->status) === 'Disponível')>Disponível</option>
                    <option value="Adotado" @selected(old('status', $animal->status) === 'Adotado')>Adotado</option>
                </select>
                @error('status') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
                <a href="{{ route('admin.animals.index') }}" class="px-4 py-2 rounded border">Voltar</a>
            </div>
        </form>
    </div>
</x-app-layout>
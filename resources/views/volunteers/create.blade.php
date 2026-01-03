<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Registo de Voluntário</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('volunteers.store') }}" class="space-y-3">
            @csrf

            <div>
                <label class="block">Disponibilidade</label>
                <input name="availability" class="w-full border rounded p-2" value="{{ old('availability') }}">
                @error('availability') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block">Competências</label>
                <textarea name="skills" class="w-full border rounded p-2" rows="4">{{ old('skills') }}</textarea>
                @error('skills') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block">Notas</label>
                <textarea name="notes" class="w-full border rounded p-2" rows="4">{{ old('notes') }}</textarea>
                @error('notes') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Submeter</button>
        </form>
    </div>
</x-app-layout>

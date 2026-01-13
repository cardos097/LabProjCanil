<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">🙋 Torna-te Voluntário</h1>
            <p class="text-gray-600">Ajuda-nos a mudar vidas dos animais no dia-a-dia</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <form method="POST" action="{{ route('volunteers.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block font-semibold text-gray-900 mb-2">Disponibilidade *</label>
                    <input name="availability" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="ex: Fins de semana, 10h-14h" value="{{ old('availability') }}">
                    @error('availability') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-gray-900 mb-2">Competências *</label>
                    <textarea name="skills" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Descreve as tuas competências e experiências">{{ old('skills') }}</textarea>
                    @error('skills') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-gray-900 mb-2">Notas</label>
                    <textarea name="notes" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Alguma coisa que gostasses de acrescentar?">{{ old('notes') }}</textarea>
                    @error('notes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg border-0">
                    ✓ Submeter Candidatura
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

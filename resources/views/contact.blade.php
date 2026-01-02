<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Contacte-nos</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('messages.store') }}" class="space-y-3">
            @csrf

            @guest
                <div>
                    <label class="block">Nome</label>
                    <input name="name" class="w-full border rounded p-2" />
                </div>

                <div>
                    <label class="block">Email</label>
                    <input name="email" type="email" class="w-full border rounded p-2" />
                </div>
            @endguest

            <div>
                <label class="block">Assunto</label>
                <input name="subject" required class="w-full border rounded p-2" />
                @error('subject')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block">Mensagem</label>
                <textarea name="message" required class="w-full border rounded p-2" rows="6"></textarea>
                @error('message')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Enviar
            </button>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="max-w-5xl mx-auto p-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">🏆 Histórias de Sucesso</h1>
            <p class="text-gray-600">Lê as histórias inspiradoras das nossas adoções felizes</p>
        </div>

        <div class="space-y-6">
            @forelse($stories as $story)
                <div class="rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden bg-white border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                        @if($story->photo)
                            <div class="md:col-span-1 h-48 md:h-auto overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $story->photo) }}" alt="{{ $story->title }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                        
                        <div class="md:col-span-{{ $story->photo ? 2 : 3 }} p-4 md:p-6">
                            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">{{ $story->title }}</h2>
                            
                            @if($story->animal)
                                <p class="text-xs md:text-sm text-blue-600 font-semibold mb-3">
                                    🐾 Animal: {{ $story->animal->name }}
                                </p>
                            @endif
                            
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed mb-4">{{ \Illuminate\Support\Str::limit($story->content, 300) }}</p>
                            
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 md:gap-0 pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500">{{ $story->created_at->format('d/m/Y') }}</span>
                                <a href="{{ route('success_stories.show', $story) }}" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                                    Ler mais →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg">Nenhuma história de sucesso publicada ainda.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

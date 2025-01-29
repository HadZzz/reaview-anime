<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Top Anime</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($topAnime as $anime)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}" 
                                     class="w-full h-64 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">
                                        <a href="{{ route('anime.show', $anime['mal_id']) }}" class="text-indigo-600 hover:text-indigo-800">
                                            {{ $anime['title'] }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <span class="mr-2">Rating: {{ $anime['score'] ?? 'N/A' }}</span>
                                        <span>Episodes: {{ $anime['episodes'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Anime Image -->
                        <div class="md:w-1/3">
                            <img src="{{ $anime['images']['jpg']['large_image_url'] }}" 
                                 alt="{{ $anime['title'] }}"
                                 class="w-full rounded-lg shadow-lg">
                        </div>

                        <!-- Anime Details -->
                        <div class="md:w-2/3 md:ml-6 mt-4 md:mt-0">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $anime['title'] }}</h1>
                            <h2 class="text-xl text-gray-600 mt-2">{{ $anime['title_japanese'] }}</h2>

                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Score:</span> {{ $anime['score'] ?? 'N/A' }}/10</p>
                                <p><span class="font-semibold">Episodes:</span> {{ $anime['episodes'] ?? 'N/A' }}</p>
                                <p><span class="font-semibold">Status:</span> {{ $anime['status'] }}</p>
                                <p><span class="font-semibold">Aired:</span> {{ $anime['aired']['string'] }}</p>
                                <p><span class="font-semibold">Genres:</span> 
                                    {{ collect($anime['genres'])->pluck('name')->join(', ') }}
                                </p>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-xl font-semibold">Synopsis</h3>
                                <p class="mt-2 text-gray-600">{{ $anime['synopsis'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recommendations Section -->
                    @if($recommendations)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold mb-6">Similar Anime</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($recommendations as $rec)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($rec['image_url'])
                                <img src="{{ $rec['image_url'] }}" alt="{{ $rec['title'] }}" 
                                     class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold mb-2">
                                        <a href="{{ route('anime.show', $rec['mal_id']) }}" 
                                           class="text-indigo-600 hover:text-indigo-800">
                                            {{ $rec['title'] }}
                                        </a>
                                    </h4>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm text-gray-600">Score: {{ $rec['score'] ?? 'N/A' }}</span>
                                        <span class="text-sm font-medium text-green-600">{{ $rec['match_score'] }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $rec['reason'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Reviews Section -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold mb-6">Reviews</h3>

                        @auth
                            <form action="{{ route('reviews.store', $anime['mal_id']) }}" method="POST" class="mb-8">
                                @csrf
                                <div class="mb-4">
                                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                    <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}/10</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Your Review</label>
                                    <textarea name="content" id="content" rows="4" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                              required></textarea>
                                </div>

                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Post Review
                                </button>
                            </form>
                        @else
                            <p class="mb-8 text-gray-600">Please <a href="{{ route('login') }}" class="text-indigo-600">login</a> to post a review.</p>
                        @endauth

                        <div class="space-y-6">
                            @forelse($reviews as $review)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">{{ $review->user->name }}</p>
                                            <p class="text-sm text-gray-600">Rating: {{ $review->rating }}/10</p>
                                        </div>
                                        @if(auth()->id() === $review->user_id)
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="mt-2">{{ $review->content }}</p>
                                    <p class="text-sm text-gray-500 mt-2">Posted {{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <p class="text-gray-600">No reviews yet. Be the first to review!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
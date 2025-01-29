<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold dark:text-white">My Watchlist</h2>
                        
                        <!-- Search and Filter -->
                        <div class="flex gap-4">
                            <input type="text" 
                                   id="search" 
                                   placeholder="Search in watchlist..." 
                                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            
                            <select id="sort" 
                                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="title-asc">Title (A-Z)</option>
                                <option value="title-desc">Title (Z-A)</option>
                                <option value="date-asc">Date Added (Oldest)</option>
                                <option value="date-desc">Date Added (Newest)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        @php
                            $totalAnime = $watchlist->sum(function($items) { return $items->count(); });
                            $completedCount = $watchlist->get('completed', collect())->count();
                            $watchingCount = $watchlist->get('watching', collect())->count();
                            $planningCount = $watchlist->get('planning', collect())->count();
                        @endphp
                        
                        <div class="bg-indigo-100 dark:bg-indigo-900 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold dark:text-white">Total Anime</h3>
                            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $totalAnime }}</p>
                        </div>
                        
                        <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold dark:text-white">Completed</h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $completedCount }}</p>
                        </div>
                        
                        <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold dark:text-white">Watching</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $watchingCount }}</p>
                        </div>
                        
                        <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold dark:text-white">Plan to Watch</h3>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $planningCount }}</p>
                        </div>
                    </div>

                    <!-- Status Tabs -->
                    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                            @foreach(['watching', 'planning', 'completed', 'dropped'] as $status)
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                            id="{{ $status }}-tab"
                                            data-tabs-target="#{{ $status }}"
                                            type="button"
                                            role="tab"
                                            aria-controls="{{ $status }}"
                                            aria-selected="false">
                                        {{ ucfirst($status) }}
                                        <span class="ml-2 bg-gray-100 text-gray-900 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                            {{ $watchlist->get($status, collect())->count() }}
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Status Content -->
                    <div id="tabContentExample">
                        @foreach(['watching', 'planning', 'completed', 'dropped'] as $status)
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" 
                                 id="{{ $status }}" 
                                 role="tabpanel" 
                                 aria-labelledby="{{ $status }}-tab">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @forelse($watchlist->get($status, collect()) as $anime)
                                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden anime-card">
                                            <img src="{{ $anime->image_url }}" 
                                                 alt="{{ $anime->title }}" 
                                                 class="w-full h-48 object-cover">
                                            <div class="p-4">
                                                <h3 class="text-lg font-semibold mb-2 dark:text-white">
                                                    <a href="{{ route('anime.show', $anime->id) }}" 
                                                       class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                                        {{ $anime->title }}
                                                    </a>
                                                </h3>
                                                
                                                <div class="mb-2 text-sm text-gray-600 dark:text-gray-300">
                                                    Added {{ $anime->pivot->created_at->diffForHumans() }}
                                                </div>
                                                
                                                <!-- Status Update Form -->
                                                <form action="{{ route('watchlist.update', $anime) }}" 
                                                      method="POST" 
                                                      class="mb-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" 
                                                            onchange="this.form.submit()" 
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                                        @foreach(['planning', 'watching', 'completed', 'dropped'] as $option)
                                                            <option value="{{ $option }}" 
                                                                    {{ $option === $status ? 'selected' : '' }}>
                                                                {{ ucfirst($option) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>

                                                <!-- Remove from Watchlist -->
                                                <form action="{{ route('watchlist.destroy', $anime) }}" 
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm">
                                                        Remove from Watchlist
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-600 dark:text-gray-400 col-span-3">
                                            No anime in {{ $status }} list yet.
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Tabs Functionality
        let tabsContainer = document.querySelector("[role=tablist]");
        let tabs = document.querySelectorAll("[role=tab]");
        let panels = document.querySelectorAll("[role=tabpanel]");

        tabs.forEach(tab => {
            tab.addEventListener('click', e => {
                let targetPanel = document.querySelector(tab.getAttribute('aria-controls'));

                panels.forEach(panel => panel.classList.add('hidden'));
                tabs.forEach(t => {
                    t.setAttribute('aria-selected', false);
                    t.classList.remove('border-indigo-600', 'text-indigo-600');
                });

                targetPanel.classList.remove('hidden');
                tab.setAttribute('aria-selected', true);
                tab.classList.add('border-indigo-600', 'text-indigo-600');
            });
        });

        // Show first tab by default
        tabs[0].click();

        // Search Functionality
        const searchInput = document.getElementById('search');
        const animeCards = document.querySelectorAll('.anime-card');
        
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            
            animeCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Sort Functionality
        const sortSelect = document.getElementById('sort');
        
        sortSelect.addEventListener('change', (e) => {
            const [criteria, direction] = e.target.value.split('-');
            const panels = document.querySelectorAll('[role="tabpanel"]');
            
            panels.forEach(panel => {
                const cards = Array.from(panel.querySelectorAll('.anime-card'));
                const sortedCards = cards.sort((a, b) => {
                    let valueA, valueB;
                    
                    if (criteria === 'title') {
                        valueA = a.querySelector('h3').textContent;
                        valueB = b.querySelector('h3').textContent;
                    } else if (criteria === 'date') {
                        valueA = a.querySelector('.text-sm').textContent;
                        valueB = b.querySelector('.text-sm').textContent;
                    }
                    
                    return direction === 'asc' 
                        ? valueA.localeCompare(valueB)
                        : valueB.localeCompare(valueA);
                });
                
                const container = panel.querySelector('.grid');
                container.innerHTML = '';
                sortedCards.forEach(card => container.appendChild(card));
            });
        });
    </script>
    @endpush
</x-app-layout> 
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class JikanService
{
    protected $baseUrl = 'https://api.jikan.moe/v4';

    public function searchAnime($query)
    {
        $cacheKey = 'anime_search_' . md5($query);

        return Cache::remember($cacheKey, 3600, function () use ($query) {
            $response = Http::get("{$this->baseUrl}/anime", [
                'q' => $query
            ]);

            return $response->json()['data'] ?? [];
        });
    }

    public function getAnimeById($id)
    {
        $cacheKey = 'anime_' . $id;

        return Cache::remember($cacheKey, 3600, function () use ($id) {
            $response = Http::get("{$this->baseUrl}/anime/{$id}");
            return $response->json()['data'] ?? null;
        });
    }

    public function getTopAnime()
    {
        return Cache::remember('top_anime', 3600, function () {
            $response = Http::get("{$this->baseUrl}/top/anime");
            return $response->json()['data'] ?? [];
        });
    }
} 
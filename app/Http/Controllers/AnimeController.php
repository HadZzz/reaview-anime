<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Services\JikanService;
use App\Services\AnimeRecommendationService;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    protected $jikanService;
    protected $recommendationService;

    public function __construct(JikanService $jikanService, AnimeRecommendationService $recommendationService)
    {
        $this->jikanService = $jikanService;
        $this->recommendationService = $recommendationService;
    }

    public function index()
    {
        $topAnime = $this->jikanService->getTopAnime();
        return view('anime.index', compact('topAnime'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $results = $this->jikanService->searchAnime($query);
        return view('anime.search', compact('results', 'query'));
    }

    public function show($id)
    {
        $anime = $this->jikanService->getAnimeById($id);
        
        // Cek apakah anime sudah ada di database, jika belum, buat baru
        $localAnime = Anime::firstOrCreate(
            ['id' => $id],
            [
                'title' => $anime['title'],
                'title_japanese' => $anime['title_japanese'],
                'synopsis' => $anime['synopsis'],
                'image_url' => $anime['images']['jpg']['image_url'],
                'episodes' => $anime['episodes'],
                'status' => $anime['status'],
                'rating' => $anime['score'],
                'genres' => collect($anime['genres'])->pluck('name')->toArray()
            ]
        );

        $reviews = $localAnime->reviews()->with('user')->latest()->get();
        
        // Dapatkan rekomendasi berdasarkan genre
        $recommendations = $this->recommendationService->getRecommendations($anime);
        
        return view('anime.show', compact('anime', 'reviews', 'recommendations'));
    }
} 
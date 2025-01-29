<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlist = auth()->user()->watchlist()->with('reviews')->get()->groupBy('pivot.status');
        return view('watchlist.index', compact('watchlist'));
    }

    public function store(Request $request, Anime $anime)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:planning,watching,completed,dropped'],
        ]);

        auth()->user()->watchlist()->syncWithoutDetaching([
            $anime->id => ['status' => $validated['status']]
        ]);

        return back()->with('success', 'Anime added to your watchlist!');
    }

    public function update(Request $request, Anime $anime)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:planning,watching,completed,dropped'],
        ]);

        auth()->user()->watchlist()->updateExistingPivot($anime->id, [
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Watchlist status updated!');
    }

    public function destroy(Anime $anime)
    {
        auth()->user()->watchlist()->detach($anime->id);
        return back()->with('success', 'Anime removed from your watchlist!');
    }
} 

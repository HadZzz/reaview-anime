<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request, $animeId)
    {
        try {
            Log::info('Review submission started', ['anime_id' => $animeId]);
            
            $validated = $request->validate([
                'content' => 'required|min:10',
                'rating' => 'required|integer|between:1,10'
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $review = Review::create([
                'user_id' => auth()->id(),
                'anime_id' => $animeId,
                'content' => $validated['content'],
                'rating' => $validated['rating']
            ]);

            Log::info('Review created successfully', ['review_id' => $review->id]);

            return back()->with('success', 'Review posted successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating review', [
                'error' => $e->getMessage(),
                'anime_id' => $animeId
            ]);
            
            return back()->with('error', 'Failed to post review. Please try again.');
        }
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}

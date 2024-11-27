<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])
            ->latest()
            ->get();
        return view('back.pages.review.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load(['user', 'product']);
        return view('back.pages.review.show', compact('review'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        $review->update([
            'status' => !$review->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rəy statusu uğurla yeniləndi.'
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.review.index')
            ->with('success', 'Rəy uğurla silindi.');
    }
}

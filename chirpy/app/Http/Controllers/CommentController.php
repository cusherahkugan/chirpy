<?php


use App\Models\Chirp;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Chirp $chirp)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        auth()->user()->comments()->create([
            'chirp_id' => $chirp->id,
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment added!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}

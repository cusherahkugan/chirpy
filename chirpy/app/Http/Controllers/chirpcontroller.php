<?php
namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        auth()->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', compact('chirp'));
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Chirp updated!');
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted!');
    }

    public function like(Chirp $chirp)
    {
        $user = auth()->user();

        if ($user->hasLiked($chirp)) {
            $user->likes()->where('chirp_id', $chirp->id)->delete();
        } else {
            $user->likes()->create(['chirp_id' => $chirp->id]);
        }

        return back();
    }

    public function show(Chirp $chirp)
    {
        $chirp->load(['user', 'comments.user', 'likes'])
              ->loadCount(['likes', 'comments']);

        return view('chirps.show', compact('chirp'));
    }
}
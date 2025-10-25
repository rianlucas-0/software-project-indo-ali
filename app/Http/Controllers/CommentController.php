<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Local $local)
{
    $request->validate([
        'content' => 'required|string|max:1000',
        'rating' => 'nullable|integer|between:1,5'
    ]);

    $local->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content,
        'rating' => $request->rating
    ]);

        return back()->with('success', 'Comentário adicionado!');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Você não tem permissão para excluir este comentário.');
        }
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'Comentário excluído com sucesso.');
    }
}
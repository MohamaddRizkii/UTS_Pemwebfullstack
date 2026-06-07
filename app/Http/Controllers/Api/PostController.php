<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        // Mengambil berita beserta data relasi kategori dan usernya
        $posts = Post::with(['category', 'user'])->latest()->get();
        return response()->json(['success' => true, 'data' => $posts], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $post = Post::create([
            'category_id' => $request->category_id,
            'user_id' => auth()->id(), // Mengambil id admin yang sedang login
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Berita berhasil diterbitkan', 'data' => $post], 201);
    }

    public function show($id) {
        $post = Post::with(['category', 'user'])->find($id);
        if (!$post) return response()->json(['message' => 'Berita tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $post], 200);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);
        if (!$post) return response()->json(['message' => 'Berita tidak ditemukan'], 404);

        $post->update($request->only(['category_id', 'title', 'content']));
        return response()->json(['message' => 'Berita berhasil diupdate', 'data' => $post], 200);
    }

    public function destroy($id) {
        $post = Post::find($id);
        if (!$post) return response()->json(['message' => 'Berita tidak ditemukan'], 404);

        $post->delete();
        return response()->json(['message' => 'Berita berhasil dihapus'], 200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(['success' => true, 'data' => Category::all()], 200);
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|unique:categories']);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json(['message' => 'Kategori berhasil dibuat', 'data' => $category], 201);
    }
}
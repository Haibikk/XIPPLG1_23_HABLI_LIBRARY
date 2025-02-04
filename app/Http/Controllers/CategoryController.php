<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status' => 200,
            'user' => $category
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        $category = Category::create($validatedData); 

        return response()->json([
            'status' => 201,
            "message" => "Category berhasil dibuat",
            "category" => [
                'name' => $category->name
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        if(!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            "message" => "Category berhasil ditemukan",
            "category" => [
                'name' => $category->name
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        return response()->json([
            'status' => 200,
            "message" => "Category berhasil diupdate",
            "category" => [
                'name' => $category->name
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category tidak ditemukan'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            "message" => "Category berhasil dihapus",
            "category" => [
                'name' => $category->name
            ]
        ], 200);
    }
}
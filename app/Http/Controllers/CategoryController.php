<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'icon' => 'image|file|max:1024'
        ]);

        if ($request->file('icon')) {
            $validatedRequest['icon'] = $request->file('icon')->store('/images');
        }
        $user = Auth::user();
        $validatedRequest['user_id'] = $user->getAuthIdentifier();
        Category::create($validatedRequest);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully created category',
            'category' => $validatedRequest
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $user = Auth::user();
        $categories = Category::where('user_id', null)
        ->orWhere('user_id', $user->id)
        ->get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($categoryId, Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'icon' => 'image|file|max:1024'
        ]);
        if ($request->file('icon')) {
            if ($request->oldIcon) {
                Storage::delete($request->oldIcon);
            }
            $validatedRequest['icon'] = $request->file('icon')->store('/images');
        }
        Category::where('id', $categoryId)
            -> update($validatedRequest);
        return response()->json([
            'status' => 'success',
            'message' => 'success update category'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        Storage::delete($category->icon);
        Category::destroy($categoryId);
        return response()->json([
            'status' => 'success',
            'message' => 'Success delete category'
        ]);
    }
}

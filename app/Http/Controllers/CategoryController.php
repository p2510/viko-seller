<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return Inertia::render('Management/Category/Index')->with([
            'categories'=>Category::where('user_id',auth()->user()->id)->latest()->get()->map(function ($category) {
                return [
                    'name' => $category->name,
                    'created_at' => $category->CreatedAt, // Assuming 'CreatedAt' is your custom accessor
                    'updated_at' => $category->UpatedAt, 
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','min:2','unique:categories'],
            'description'=>['required','min:12']
        ]);
        $data['user_id'] = auth()->user()->id;
        Category::create($data);
        return redirect()->back()->with('message', 'Nouvelle catégorie crée !!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Management/Category/Edit')->with([
            'category'=>Category::find($category->id),
        ]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data=$request->validate([
            'name'=>['required','min:2','unique:categories'],
            'description'=>['required','min:12']
        ]);
        Category::whereId($category->id)->update([
            'name'=>$data['name'],
            'description'=>$data['description'],
        ]);
        return redirect()->route('category.index')->with('update', 'Catégorie mise à jour');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->back();
    }
}
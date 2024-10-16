<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::paginate(2);
        return view('dashboard.categories.categories', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $parent = Category::all();
        return view('dashboard.categories.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['image'] = $path;
        }

        Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'parent_id' => $data['parent_id'],
            'slug' => $data['slug']
        ]);
        return redirect('categories')->with('success', 'category added successed');
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
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);  // This replaces route model binding
        } catch (ModelNotFoundException $e) {
            return redirect('categories')->with('info', 'The record was not found!');
        }

        $parent = Category::all();

        return view('dashboard.categories.edit', compact('category', 'parent'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules());
        $data = Category::find($id);
        $data->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            
        ]);
        return to_route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('danger','Category deleted');
    }
}

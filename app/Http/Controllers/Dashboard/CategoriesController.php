<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CategoriesController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth',except:['index']) 
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return view('dashboard.categories.categories',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $parent = Category::all();
        return view('dashboard.categories.create',compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug'=>Str::slug($request->name)
        ]);
        $data = $request->except('image');
        
        if($request->hasFile('image')){
            $file =$request->file('image');
            $path = $file->store('uploads',['disk'=>'public']);
            $data['image']= $path;
        }

        Category::create([
            'name'=> $data['name'],
            'description' => $data['description'],
            'parent_id' =>$data['parent_id'],
            'slug' => $data['slug']
        ]);
        return redirect('categories')->with('success','category added successed');
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
        try{$category;}
        catch(Exception $e){
            return redirect()->route('dashboard.categoires.categories')->with('info','the record not found!');
        }
        
        return view('dashboard.categories.edit',compact('category','parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
            $category->delete();
            return redirect()->route('categories.index');
    }
}

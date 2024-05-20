<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\services\Traits\apiresponse;

class CategoryController extends Controller
{
    use apiresponse;

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $categories=Category::paginate(20);
     return response()->$this->successResponse(new CategoryResource($categories),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $category=new Category();
        

        return $this->successResponse(new CategoryResource($category),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->successResponse(new CategoryResource($category),200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        
    }
}

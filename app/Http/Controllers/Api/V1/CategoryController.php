<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\services\Traits\apiresponse;
use Illuminate\Http\JsonResponse;
class CategoryController extends Controller
{
    use apiresponse;

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $categories=Category::paginate(20);
     return response()->$this->successResponse(CategoryResource::collection($categories),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $validated = $request->safe()->only(['name']);
            if (!empty($validated)) {
                $category=new Category();
                $category->name = $validated['name']; 
                $category->save();
                return $this->successResponse(new CategoryResource($category), 200);
            }
        } catch (\Exception $e) {
            return $this->errorResponse("An error occurred MAN oops ALI : " . $e->getMessage(), [], 500);
        }
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
    public function update(UpdateCategoryRequest $request, Category $category)
{
    try {
        $validated = $request->safe()->only(['name']);
        if (!empty($validated)) {
            $category->name = $validated['name']; 
            $category->save();
            return $this->successResponse(new CategoryResource($category), 200);
        }
    } catch (\Exception $e) {
        return $this->errorResponse("An error occurred MAN oops ALI : " . $e->getMessage(), [], 500);
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $data='the category deleted succussefully';
        return $this->successResponse($data,200);
    }
}

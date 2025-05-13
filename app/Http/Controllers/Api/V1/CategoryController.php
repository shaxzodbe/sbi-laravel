<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends BaseApiController
{
    /**
     * CategoryController constructor.
     */
    public function __construct(private readonly CategoryService $categoryService) {}

    /**
     * Display a listing of categories.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', config('pagination.per_page'));

        $categories = $this->categoryService->list($perPage);

        return $this->successResponse(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $category = $this->categoryService->create($validatedData);

        return $this->successResponse(new CategoryResource($category), Response::HTTP_CREATED);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): JsonResponse
    {
        $categoryData = $this->categoryService->find($category->id);

        return $this->successResponse(new CategoryResource($categoryData));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $validatedData = $request->validated();

        $updatedCategory = $this->categoryService->update($category, $validatedData);

        return $this->successResponse(new CategoryResource($updatedCategory));
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category);

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}

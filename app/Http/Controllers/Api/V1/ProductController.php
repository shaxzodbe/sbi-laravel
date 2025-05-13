<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends BaseApiController
{
    /**
     * ProductController constructor.
     */
    public function __construct(private readonly ProductService $productService) {}

    /**
     * Display a listing of products.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', config('pagination.per_page'));

        $products = $this->productService->list($perPage);

        return $this->successResponse(ProductResource::collection($products));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = $this->productService->create($validatedData);

        return $this->successResponse(new ProductResource($product), Response::HTTP_CREATED);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): JsonResponse
    {
        $productData = $this->productService->find($product->id);

        return $this->successResponse(new ProductResource($productData));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $validatedData = $request->validated();

        $updatedProduct = $this->productService->update($product, $validatedData);

        return $this->successResponse(new ProductResource($updatedProduct));
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product);

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function export(): JsonResponse
    {
        $this->productService->exportToExcel();

        return $this->successResponse(['message' => 'Экспорт в Excel запущен.']);
    }
}

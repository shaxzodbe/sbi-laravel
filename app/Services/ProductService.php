<?php

namespace App\Services;

use App\Contracts\ProductRepositoryInterface;
use App\Jobs\ExportProductsToExcelJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class ProductService
{
    public function __construct(private ProductRepositoryInterface $repository) {}

    public function list(int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function find(int $id): ?Model
    {
        return $this->repository->find($id);
    }

    public function update($product, array $data): Model
    {
        return $this->repository->update($product, $data);
    }

    public function delete($product): bool
    {
        return $this->repository->delete($product);
    }

    public function exportToExcel(): void
    {
        ExportProductsToExcelJob::dispatch();
    }
}

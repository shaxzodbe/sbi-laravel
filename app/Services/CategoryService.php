<?php

namespace App\Services;

use App\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $repository) {}

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

    public function update($category, array $data): Model
    {
        return $this->repository->update($category, $data);
    }

    public function delete($category): bool
    {
        return $this->repository->delete($category);
    }
}

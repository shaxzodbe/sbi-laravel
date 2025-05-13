<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    protected function query(): Builder
    {
        return parent::query()->with('category');
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderBy('id')->paginate($perPage);
    }

    public function find(int $id): ?Product
    {
        return $this->query()->findOrFail($id);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model->fresh('category');
    }
}

<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return parent::query()->orderBy('id')->paginate($perPage);
    }
}

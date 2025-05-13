<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
}

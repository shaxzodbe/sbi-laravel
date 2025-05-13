<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
}

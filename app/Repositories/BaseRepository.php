<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    protected function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function all(): Collection
    {
        return $this->query()->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model->fresh();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}

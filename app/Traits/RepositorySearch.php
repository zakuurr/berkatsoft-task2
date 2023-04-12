<?php

namespace App\Traits;

trait RepositorySearch
{
    public function searchableColumn(array $searchableColumn)
    {
        if (request()->input("search")) {
            $searchTerm = request()->input("search");

            foreach ($searchableColumn as $key => $value) {
                $this->model = $this->model->orWhere($value, "LIKE", "%$searchTerm%");
            }
        }

        return $this;
    }
}

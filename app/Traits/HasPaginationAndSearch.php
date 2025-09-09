<?php

namespace App\Traits;

trait HasPaginationAndSearch
{
    public $searchQuery = '';
    public $paginate = 10;

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }

    public function updatedPaginate()
    {
        $this->resetPage();
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $cate;
    public $perPage;
    public $products;
    public $cateall;

    public function render()
    {

        return view('livewire.product-list', [
            'cate' => $this->cate,
            'perPage' => $this->perPage,
            'products' => $this->products,
            'cateall' => $this->cateall
        ]);
    }
}

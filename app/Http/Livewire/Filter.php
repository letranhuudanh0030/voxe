<?php

namespace App\Http\Livewire;

use App\Product;
use App\Size;
use Livewire\Component;

class Filter extends Component
{

    public $filter;
    public $categories;
    public $category;
    public $perPage;
    public $cateall;

    // protected $queryString = ['filter' => ['except' => '']];

    public function mount()
    {
        $this->fill(request()->only('filter'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // dd($this);
        if($this->filter){
            $size = Size::where('publish', 1)->where('code', $this->filter)->first();
            $products = $size->product;
        } else{
            $products = Product::all();
        }

        return view('livewire.filter', [
            'filter' => $this->filter,
            'products' => $products,
            'categories' => $this->categories,
            'perPage' => $this->perPage,
            'category' => $this->category,
            'cateall' => $this->cateall
        ]);

    }
}

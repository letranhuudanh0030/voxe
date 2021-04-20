<?php

namespace App\Http\Livewire;

use App\Product;
use App\ProductCategory;
use Livewire\Component;

class MegaMenuContent extends Component
{

    protected $listeners = ['showContent', 'closeContent', 'inContent', 'outContent']; 
    
    public $cateId;
    public $hover;
    public $openContent;

    public function showContent($id)
    {
        $this->cateId = $id;
        $this->hover = true;
    }

    public function closeContent()
    {
        // $this->cateId = null;
        // $this->hover = false;
    }

    public function inContent()
    {
        $this->hover = true;
    }

    public function outContent()
    {
        // $this->cateId = null;
        $this->hover = false;   
    }


    public function render()
    {
        if(empty($this->cateId)){
            $products = [];
        } else {
            $category = ProductCategory::with('products')->where('id', $this->cateId)->where('publish', 1)->first();
            if(empty($category) || $category->id == 25){
                $products = Product::where('publish', 1)->get();
            } else {
                $products = $category->products;
            }
        }
        
        return view('livewire.mega-menu-content', ['products' => $products]);
    }
}

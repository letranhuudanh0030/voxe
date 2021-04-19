<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'price' => $this->price,
            'dis_price' => $this->dis_price,
            'avatar_image' => $this->avatar_image,
            'images' => $this->images,
            'short_desc' => $this->short_desc,
            'content' => $this->content,
            'publish' => $this->publish,
            'highlight' => $this->highlight,
            'lastest' => $this->lastest,
            'meta_title' => $this->meta_title,
            'meta_keyword' => $this->meta_keyword,
            'meta_desc' => $this->meta_desc,
            'sort_order' => $this->sort_order,
            'view' => $this->view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'unit' => [
                'id' => $this->Size->first()['id'],
                'title' => $this->Size->first()['title'],
                'slug' => $this->Size->first()['slug'],
                'publish' => $this->Size->first()['publish'],
            ],
            'category' => [
                'id' => $this->productCategory->id,
                'title' => $this->productCategory->name,
                'slug' => $this->productCategory->slug,
                'pushlish' => $this->productCategory->publish,
                'highlight' => $this->productCategory->highlight
            ]
        ];
    }
}

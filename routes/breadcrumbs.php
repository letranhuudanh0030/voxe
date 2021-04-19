<?php


Breadcrumbs::for('home', function ($trail) {

    $lang_current = config('app.locale');
    if($lang_current == 'vi'){
        $trail->push('Trang chủ', route('home'));
    } else {
        $trail->push('Home', route('home'));
    }
});


Breadcrumbs::for('category', function ($trail, $category, $categories) {
    $trail->parent('home');
    $parent_root = $categories->where('parent_id', 0)->first();
    if($category->parent_id != $parent_root->id){
        $parent = $categories->where('id', $category->parent_id)->first();
        if (Session::get('lang') == 'vi' || !Session::get('lang')){
            $trail->push($parent->name, route('menu', $parent->slug));
        }else{
            if ($parent->language){
                foreach ($parent->language as $lang){
                    if ($lang->name_code == Session::get('lang')){
                        $trail->push($lang->pivot->title, route('menu', $lang->pivot->slug));
                    }
                }
            }
        }
        
    }
    if (Session::get('lang') == 'vi' || !Session::get('lang')){
        $trail->push($category->name, route('menu', $category->slug));
    }else{
        if ($category->language){
            foreach ($category->language as $lang){
                if ($lang->name_code == Session::get('lang')){
                    $trail->push($lang->pivot->title, route('menu', $category->slug));
                }
            }
        }
    }
    
});



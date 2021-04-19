<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\Menu;
use App\MenuLocation;
use App\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.menu.index')->with('title_page', 'Menu')
                                        ->with('create_page', 'menus.create')
                                        ->with('list_page', 'menus.index')
                                        ->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $aricleCate = ArticleCategory::where('publish', 1)->where('parent_id', 0)->get();
        $productCate = ProductCategory::where('publish', 1)->get();
        $locations = MenuLocation::where('publish', 1)->get();
        $languages = Language::where('publish', 1)->get();
        // dd(json_decode($languages));

        return view('admin.menu.create')->with('title_page', 'Thêm menu')
                                        ->with('create_page', 'menus.create')
                                        ->with('list_page', 'menus.index')
                                        ->with('aricleCate', $aricleCate)
                                        ->with('productCate', $productCate)
                                        ->with('locations', $locations)
                                        ->with('languages', $languages)
                                        ->with('menu', null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->module_id);
        $this->validate($request, [
            'title' => 'required',
            'location_id' => 'required',
        ]);

        $url = null;
        if($request->url){
            $url = $request->url;
        } else {
            $url = Str::slug($request->title, '-');
        }

        $menu = Menu::create([
            'title' => $request->title,
            'url' => $url,
            'location_id' => $request->location_id,
            'module' => $request->module,
            'module_id' => $request->module_id,
            'module_item' => $request->module_item,
            'publish' => $request->publish
        ]);


        $data_pivot = [];
        if($request->language) {

            for ($i=0; $i < count($request->language); $i++) {

                $url_lang = '';
                if($request->slug_lang[$i]){
                    $url_lang = $request->url_lang[$i];
                } else {
                    $url_lang = Str::slug($request->title_lang[$i], '-');
                }

                $data_pivot[$request->language[$i]] = [
                    'title' => $request->title_lang[$i],
                    'url' => $url_lang
                ];
            }
        }
        $menu->language()->attach($data_pivot);

        // $menu->language()->attach($request->language, [
        //     'title' => $request->title_lang,
        //     'url' => $request->url_lang
        // ]);


        if($request->module_id){

            $category_slug = null;
            if($request->module == 'product_catalogua'){
                $category_slug = ProductCategory::findOrFail($request->module_id);
            } else {
                $category_slug = ArticleCategory::findOrFail($request->module_id);
            }

            $category_slug->slug = $url;
            $category_slug->save();
        }


        Session::flash('success', 'Tạo menu thành công.');

        if($request->close) {
            return redirect()->route('menus.index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aricleCate = ArticleCategory::where('publish', 1)->where('parent_id', 0)->get();
        $productCate = ProductCategory::where('publish', 1)->get();
        // $productCateParent = ProductCategory::where('publish', 1)->where('parent_id', 0)->get();
        $locations = MenuLocation::where('publish', 1)->get();
        $menu = Menu::findOrFail($id);
        $languages = Language::where('publish', 1)->get();
        
        return view('admin.menu.edit')->with('title_page', 'Menu')
        ->with('create_page', 'menus.create')
        ->with('list_page', 'menus.index')
        ->with('menu', $menu)
        ->with('aricleCate', $aricleCate)
        ->with('productCate', $productCate)
        // ->with('productCateParent', $productCateParent)
        ->with('locations', $locations)
        ->with('languages', $languages);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'location_id' => 'required',
        ]);

        $menu = Menu::findOrFail($id);


        $url = null;
        if($request->url){
            $url = $request->url;
        } else {
            $url = Str::slug($request->title, '-');
        }

        $menu->title = $request->title;
        $menu->url = $url;
        $menu->location_id = $request->location_id;
        $menu->module = $request->module;
        $menu->module_id = $request->module_id;
        $menu->module_item = $request->module_item;
        $menu->publish = $request->publish;
        $menu->updated_at = Carbon::now();
        $menu->save();



        $data_pivot = [];
        if($request->language) {

            for ($i=0; $i < count($request->language); $i++) {
                $data_pivot[$request->language[$i]] = [
                    'title' => $request->title_lang[$i],
                    'url' => $request->url_lang[$i]
                ];
            }
        }

        $menu->language()->sync($data_pivot);

        if($request->module_id){

            $category_slug = null;


            if($request->module == 'product_catalogua'){
                $category_slug = ProductCategory::findOrFail($request->module_id);
            } else {
                $category_slug = ArticleCategory::findOrFail($request->module_id);
            }

            $category_slug->slug = $url;
            $category_slug->save();
        }

        Session::flash('success', 'Cập nhật menu thành công.');

        if($request->close) {
            return redirect()->route('menus.index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $menu = Menu::find($data['id']);
        if($data['name'] == 'publish') {
            $menu->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $menu->sort_order = $data['value'];
        }
        $menu->updated_at = Carbon::now();
        $menu->save();
    }

    public function remove()
    {
        $menu = Menu::find(request()->id);
        $menu->delete();
        $menu->language()->detach();
    }

    public function search($id)
    {
        $menuLocations = MenuLocation::orderBy('created_at', 'desc')->where('id', $id)->paginate(12);
        return view('admin.menuLocation.index')->with('title_page', 'Vị trí menu')
                                        ->with('create_page', 'menu-location.create')
                                        ->with('list_page', 'menu-location.index')
                                        ->with('menuLocations', $menuLocations);
    }

    public function searchMenu()
    {
        $menus = Menu::orderBy('created_at', 'desc')->where('title', 'like', '%' . request()->search_name . '%')->paginate(12);
        return view('admin.menu.index')->with('title_page', 'Menu')
                                        ->with('create_page', 'menus.create')
                                        ->with('list_page', 'menus.index')
                                        ->with('menus', $menus);
    }

}

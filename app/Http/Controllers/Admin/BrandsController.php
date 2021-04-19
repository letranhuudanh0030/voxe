<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::sortable(['id' => 'desc'])->paginate(10);

        return view('admin.brands.index')->with('title_page', 'Danh sách hãng sản xuất')
                                            ->with('create_page', 'brands.create')
                                            ->with('list_page', 'brands.index')
                                            ->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        // dd($brands);
        return view('admin.brands.create')->with('title_page', 'Thêm mới hãng sản xuất')
                                            ->with('create_page', 'brands.create')
                                            ->with('list_page', 'brands.index')
                                            ->with('brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:brands'
        ]);

        $slug = '';
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->name, '-');
        }

        Brand::create([
            'name' => $request->name,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'slug' => $slug,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'parent_id' => $request->parent_id
        ]);

        Session::flash('success', 'Thêm hãng sản xuất thành công.');

        if($request->close) {
            return redirect()->route('brands.index');
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
        $brand = Brand::findOrFail($id);
        $brands = Brand::all();

        return view('admin.brands.edit')->with('title_page', 'Cập nhật hãng sản xuất')
                                        ->with('create_page', 'brands.create')
                                        ->with('list_page', 'brands.index')
                                        ->with('brand', $brand)
                                        ->with('brands', $brands);
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
            'name' => 'required'
        ]);
        // dd($request->all());

        $brand = Brand::find($id);

        $brand->name = $request->name;
        if($request->avatar_image) {

            $brand->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $brand->publish = $request->publish;
        $brand->meta_title = $request->meta_title;
        if($request->slug){
            $brand->slug = $request->slug;
        } else {
            $brand->slug = Str::slug($request->name, '-');
        }
        $brand->meta_keyword = $request->meta_keywords;
        $brand->meta_desc = $request->meta_description;
        $brand->parent_id = $request->parent_id;

        $brand->save();

        Session::flash('success', 'Cập nhật hãng sản xuất thành công.');


        return redirect()->back();

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

    public function remove()
    {
        $brand = Brand::findOrFail(request()->id);
        $products = $brand->product();

        $products->delete();

        if($products->count() == 0){
            $brand->delete();

        }

    }

    public function search($name = null)
    {
        if($name) {
            $brands = Brand::where('name', $name)
                                                ->sortable()->paginate(10);
        } else {
            $brands = Brand::where('name','LIKE', request()->search_name.'%')
                                                ->sortable()->paginate(10);
        }

        return view('admin.brands.index')->with('title_page', 'Danh sách hãng sản xuất')
                                            ->with('brands', $brands)
                                            ->with('create_page', 'brands.create')
                                            ->with('list_page', 'brands.index');;
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $brand = Brand::find($data['id']);
        if($data['name'] == 'publish') {
            $brand->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $brand->sort_order = $data['value'];
        }
        $brand->updated_at = Carbon::now();
        $brand->save();

    }
}

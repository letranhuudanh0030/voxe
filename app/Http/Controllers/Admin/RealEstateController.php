<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\RealEstate;
use App\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estates = RealEstate::orderBy('id', 'desc')->paginate(100);
        $category = ProductCategory::all();
        // dd($estates);

        return view('admin.realestate.index')->with('title_page', 'Bất động sản')
            ->with('create_page', 'estate.create')
            ->with('list_page', 'estate.index')
            ->with('estates', $estates)
            ->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::where('publish', 1)->get();
        $cate_dcn = $productCategories->where('slug', 'dat-cong-nghiep')->first();
        $cate_nxnk = $productCategories->where('slug', 'nha-xuong-nha-kho')->first();

        return view('admin.realestate.create')->with('title_page', 'Thêm bất động sản')
            ->with('create_page', 'estate.create')
            ->with('list_page', 'estate.index')
            ->with('cate_dcn', $cate_dcn)
            ->with('cate_nxnk', $cate_nxnk)
            ->with('productCategories', $productCategories)
            ->with('estate', null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (empty($request->slug)) {
            $request->merge(['slug' => Str::slug($request->title, '-')]);
        }

        $images = null;
        if ($request->images) {
            $imgArr = json_decode($request->images);
            if (is_array($imgArr)) {

                foreach ($imgArr as $key => $image) {
                    if ($key > 0) {

                        $images .= ',' . str_replace(url('/'), '', $image);
                    } else {
                        $images .= str_replace(url('/'), '', $image);
                    }
                }
            } else {
                $images = $request->images;
            }
        }

        if ($images) {
            $request->merge(['images' => $images]);
        }

        if ($request->avatar_image) {
            $avatar_image = str_replace(url('/'), '', $request->avatar_image);
            $request->merge(['avatar_image' => $avatar_image]);
        }

        if (!empty($request->product_category_id_nxnk)) {
            $request->merge(['product_category_id' => $request->product_category_id_nxnk]);
        }

        // dd($request->except(['close', 'back']));
        $estate = RealEstate::create($request->except(['close', 'back', 'title_lang', 'contact_lang', 'description_lang', 'condition_lang', 'functional_subdivision_lang', 'infrastructure_lang', 'investment_costs_lang', 'career_lang', 'incentives_lang', 'meta_title_lang', 'slug_lang', 'meta_keyword_lang', 'meta_desc_lang', 'language']));

        $data_pivot = [];
        if ($request->language) {

            for ($i = 0; $i < count($request->language); $i++) {

                $slug_lang = '';
                if ($request->slug_lang[$i]) {
                    $slug_lang = $request->slug_lang[$i];
                } else {
                    $slug_lang = Str::slug($request->title_lang[$i], '-');
                }

                $data_pivot[$request->language[$i]] = [
                    'title' => $request->title_lang[$i],
                    'contact' => $request->contact_lang[$i],
                    'description' => $request->description_lang[$i],
                    'condition' => $request->condition_lang[$i],
                    'functional_subdivision' => $request->functional_subdivision_lang[$i],
                    'infrastructure' => $request->infrastructure_lang[$i],
                    'investment_costs' => $request->investment_costs_lang[$i],
                    'career' => $request->career_lang[$i],
                    'incentives' => $request->incentives_lang[$i],
                    'suport' => $request->suport_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }

            $estate->language()->attach($data_pivot);
        }

        Session::flash('success', 'Thêm tin bất động sản thành công.');

        if ($request->close) {
            return redirect()->route('estate.index');
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
        $estate = RealEstate::findOrFail($id);
        $productCategories = ProductCategory::where('publish', 1)->get();
        $cate_dcn = $productCategories->where('slug', 'dat-cong-nghiep')->first();
        $cate_nxnk = $productCategories->where('slug', 'nha-xuong-nha-kho')->first();
        return view('admin.realestate.edit')->with('title_page', 'Cập nhật bất động sản')
            ->with('create_page', 'estate.create')
            ->with('list_page', 'estate.index')
            ->with('cate_dcn', $cate_dcn)
            ->with('cate_nxnk', $cate_nxnk)
            ->with('productCategories', $productCategories)
            ->with('estate', $estate)
            ->with('aItem', $estate);
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
        $estate = RealEstate::findOrFail($id);
        if (empty($request->images)) {
            $request->merge(['images' => $estate->images]);
        } else {
            $images = null;
            if ($request->images) {
                $imgArr = json_decode($request->images);
                if (is_array($imgArr)) {

                    foreach ($imgArr as $key => $image) {
                        if ($key > 0) {

                            $images .= ',' . str_replace(url('/'), '', $image);
                        } else {
                            $images .= str_replace(url('/'), '', $image);
                        }
                    }
                } else {
                    $images = $request->images;
                }
            }

            $request->merge(['images' => $images]);
        }

        if ($request->avatar_image) {
            $avatar_image = str_replace(url('/'), '', $request->avatar_image);
            $request->merge(['avatar_image' => $avatar_image]);
        }

        $estate->update($request->except(['close', 'back', 'title_lang', 'contact_lang', 'description_lang', 'condition_lang', 'functional_subdivision_lang', 'infrastructure_lang', 'investment_costs_lang', 'career_lang', 'incentives_lang', 'meta_title_lang', 'slug_lang', 'meta_keyword_lang', 'meta_desc_lang', 'language']));

        $data_pivot = [];
        if ($request->language) {

            for ($i = 0; $i < count($request->language); $i++) {

                $slug_lang = '';
                if ($request->slug_lang[$i]) {
                    $slug_lang = $request->slug_lang[$i];
                } else {
                    $slug_lang = Str::slug($request->title_lang[$i], '-');
                }

                $data_pivot[$request->language[$i]] = [
                    'title' => $request->title_lang[$i],
                    'contact' => $request->contact_lang[$i],
                    'description' => $request->description_lang[$i],
                    'condition' => $request->condition_lang[$i],
                    'functional_subdivision' => $request->functional_subdivision_lang[$i],
                    'infrastructure' => $request->infrastructure_lang[$i],
                    'investment_costs' => $request->investment_costs_lang[$i],
                    'career' => $request->career_lang[$i],
                    'incentives' => $request->incentives_lang[$i],
                    'suport' => $request->suport_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }

            $estate->language()->sync($data_pivot);
        }

        Session::flash('success', 'Cập nhật tin bất động sản thành công.');

        if ($request->close) {
            return redirect()->route('estate.index');
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
        $estate = RealEstate::find($data['id']);
        if ($data['name'] == 'publish') {
            $estate->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $estate->highlight = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $estate->sort_order = $data['value'];
        } elseif ($data['name'] == 'lastest') {
            $estate->lastest = $data['value'];
        }
        $estate->updated_at = Carbon::now();
        $estate->save();

        return response($estate);
    }

    public function remove()
    {
        $estate = RealEstate::find(request()->id);
        $estate->delete();
        $estate->language()->dettach();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);


        foreach ($ids as $id) {
            if ($id != '') {
                $estate = RealEstate::find($id);
                $estate->delete();
                if($estate->pivot){
                    $estate->language()->dettach();
                }
            }
        }
    }

    public function filter(Request $request)
    {
        $condition = [];

        if ($request->title != null) {
            $condition[] = ['title', 'like', $request->title . '%'];
        }
        if ($request->type_spec != null) {
            $condition[] = ['type_spec', $request->type_spec];
        }

        if ($request->region_code != null) {
            $condition[] = ['region_code', $request->region_code];
        }
        if ($request->city_code != null) {
            $condition[] = ['city_code', $request->city_code];
        }
        if ($request->district_code != null) {
            $condition[] = ['district_code', $request->district_code];
        }
        if ($request->ward_code != null) {
            $condition[] = ['ward_code', $request->ward_code];
        }
        if ($request->acreage != null) {
            switch ($request->acreage) {
                case '1':
                    $condition[] = ['acreage', '<', '30'];
                    break;
                case '2':
                    $condition[] = ['acreage', '>=', '30'];
                    $condition[] = ['acreage', '<', '50'];
                    break;
                case '3':
                    $condition[] = ['acreage', '>=', '50'];
                    $condition[] = ['acreage', '<', '80'];
                    break;
                case '4':
                    $condition[] = ['acreage', '>=', '80'];
                    $condition[] = ['acreage', '<', '100'];
                    break;
                case '5':
                    $condition[] = ['acreage', '>=', '100'];
                    $condition[] = ['acreage', '<', '150'];
                    break;
                case '6':
                    $condition[] = ['acreage', '>=', '150'];
                    $condition[] = ['acreage', '<', '200'];
                    break;
                case '7':
                    $condition[] = ['acreage', '>=', '200'];
                    $condition[] = ['acreage', '<', '250'];
                    break;
                case '8':
                    $condition[] = ['acreage', '>=', '250'];
                    $condition[] = ['acreage', '<', '300'];
                    break;
                case '9':
                    $condition[] = ['acreage', '>=', '300'];
                    $condition[] = ['acreage', '<', '500'];
                    break;
                case '10':
                    $condition[] = ['acreage', '>', '500'];
                    break;
                default:
                    $condition[] = ['acreage', '0'];
                    break;
            }
        }
        if ($request->price_range != null) {
            switch ($request->price_range) {
                case '1':
                    $condition[] = ['price', '<', '1000000'];
                    break;
                case '2':
                    $condition[] = ['price', '>=', '1000000'];
                    $condition[] = ['price', '<', '3000000'];
                    break;
                case '3':
                    $condition[] = ['price', '>=', '3000000'];
                    $condition[] = ['price', '<', '5000000'];
                    break;
                case '4':
                    $condition[] = ['price', '>=', '5000000'];
                    $condition[] = ['price', '<', '10000000'];
                    break;
                case '5':
                    $condition[] = ['price', '>=', '10000000'];
                    $condition[] = ['price', '<', '40000000'];
                    break;
                case '6':
                    $condition[] = ['price', '>=', '40000000'];
                    $condition[] = ['price', '<', '70000000'];
                    break;
                case '7':
                    $condition[] = ['price', '>=', '70000000'];
                    $condition[] = ['price', '<', '100000000'];
                    break;
                case '8':
                    $condition[] = ['price', '>', '100000000'];
                    break;
                default:
                    $condition[] = ['price', '0'];
                    break;
            }
        }
        if (!empty($request->all())) {
            // $condition[] = ['publish', 1];
        }

        // dd($condition);
        $products = RealEstate::where($condition)->orderBy('id', 'desc')->paginate(10);
        // dd($products);
        $category = ProductCategory::all();
        return view('admin.realestate.index')->with('title_page', 'Bất động sản')
            ->with('create_page', 'estate.create')
            ->with('list_page', 'estate.index')
            ->with('estates', $products)
            ->with('category', $category);
    }
}

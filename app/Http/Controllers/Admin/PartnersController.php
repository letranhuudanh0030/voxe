<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.partner.index')->with('title_page', 'Danh sách đối tác')
                                            ->with('create_page', 'partners.create')
                                            ->with('list_page', 'partners.index')
                                            ->with('partners', $partners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create')->with('title_page', 'Danh sách đối tác')
                                            ->with('create_page', 'partners.create')
                                            ->with('list_page', 'partners.index');
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
            'title' => 'required|unique:partners',
            'avatar_image' => 'required',
        ]);

        Partner::create([
            'title' => $request->title,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'link' => $request->link,
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'type_id' => $request->type_id
        ]);

        Session::flash('success', 'Thêm đối tác thành công.');

        if($request->close) {
            return redirect()->route('partners.index');
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
        $partner = Partner::find($id);
        return view('admin.partner.edit')->with('title_page', 'Danh sách đối tác')
                                        ->with('create_page', 'partners.create')
                                        ->with('list_page', 'partners.index')
                                        ->with('partner', $partner);
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
        ]);

        $partner = Partner::find($id);
        $partner->title = $request->title;
        if($request->avatar_image){

            $partner->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $partner->link = $request->link;
        $partner->publish = $request->publish;
        $partner->meta_title = $request->meta_title;
        $partner->meta_keywords = $request->meta_keywords;
        $partner->meta_desc = $request->meta_description;
        $partner->type_id = $request->type_id;
        $partner->updated_at = Carbon::now();

        $partner->save();

        Session::flash('success', 'Cập nhật đối tác thành công.');

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
        $partner = Partner::find(request()->id);
        $partner->delete();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);

        foreach ($ids as $id) {
            if($id != '') {
                $partner = Partner::find($id);
                $partner->delete();
            }
        }
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $partner = Partner::find($data['id']);
        if($data['name'] == 'publish') {
            $partner->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $partner->sort_order = $data['value'];
        }
        $partner->updated_at = Carbon::now();
        $partner->save();
    }

    public function search($name = null)
    {
        if($name) {
            $partner = Partner::where('title', $name)
                                                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $partner = Partner::where('title','LIKE', request()->search_name.'%')
                                                ->orderBy('created_at', 'desc')->paginate(10);
        }


        return view('admin.partner.index')->with('title_page', 'Danh sách đối tác')
                                            ->with('partners', $partner)

                                            ->with('create_page', 'partners.create')
                                            ->with('list_page', 'partners.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.gallery.index')->with('title_page', 'Thư viện ảnh')
                                            ->with('create_page', 'galleries.create')
                                            ->with('list_page', 'galleries.index')
                                            ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create')->with('title_page', 'Thêm ảnh')
                                            ->with('create_page', 'galleries.create')
                                            ->with('list_page', 'galleries.index');
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
        $this->validate($request, [
            'title' => 'required|unique:galleries',
            'avatar_image' => 'required',
        ]);

        Gallery::create([
            'title' => $request->title,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'link' => $request->link,
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description

        ]);

        Session::flash('success', 'Thêm ảnh vào thư viện thành công.');

        if($request->close){
            return redirect()->route('galleries.index');
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
        $gallery = Gallery::find($id);
        return view('admin.gallery.edit')->with('title_page', 'Cập nhật ảnh thư viện')
                                            ->with('create_page', 'galleries.create')
                                            ->with('list_page', 'galleries.index')
                                            ->with('gallery', $gallery);
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
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required'
        ]);

        $gallery = Gallery::find($id);

        $gallery->title = $request->title;
        if($request->avatar_image){

            $gallery->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $gallery->link = $request->link;
        $gallery->publish = $request->publish;
        $gallery->meta_title = $request->meta_title;
        $gallery->meta_keyword = $request->meta_keywords;
        $gallery->meta_desc = $request->meta_description;

        $gallery->save();

        Session::flash('success', 'Cập nhật ảnh trong thư viện thành công.');

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

    }

    public function remove()
    {
        $gallery = Gallery::find(request()->id);
        $gallery->delete();
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $gallery = Gallery::find($data['id']);
        if($data['name'] == 'publish') {
            $gallery->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $gallery->sort_order = $data['value'];
        }
        $gallery->updated_at = Carbon::now();
        $gallery->save();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);

        foreach ($ids as $id) {
            if($id != '') {
                $gallery = Gallery::find($id);
                $gallery->delete();
            }
        }
    }

    public function showGallery()
    {
        return view('admin.gallery.manager')->with('title_page', 'Gallery');
    }
}

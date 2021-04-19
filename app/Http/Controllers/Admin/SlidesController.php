<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.slides.index')->with('title_page', 'danh sách ảnh slide')
                                        ->with('create_page', 'slides.create')
                                        ->with('list_page', 'slides.index')
                                        ->with('slides', $slides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create')->with('title_page', 'thêm ảnh slide')
                                        ->with('create_page', 'slides.create')
                                        ->with('list_page', 'slides.index');
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
            'avatar_image' => 'required'
        ]);

        Slide::create([
            'title' => $request->title,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'link' => $request->link,
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description
        ]);

        Session::flash('success', 'Thêm ảnh slide thành công.');

        if($request->close) {
            return redirect()->route('slides.index');
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
        $slide = Slide::find($id);
        return view('admin.slides.edit')->with('title_page', 'Cập nhật ảnh slide')
                                        ->with('create_page', 'slides.create')
                                        ->with('list_page', 'slides.index')
                                        ->with('slide', $slide);
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

        $slide = Slide::find($id);
        $slide->title = $request->title;
        if($request->avatar_image) {

            $slide->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $slide->link = $request->link;
        $slide->publish = $request->publish;
        $slide->meta_title = $request->meta_title;
        $slide->meta_keyword = $request->meta_keywords;
        $slide->meta_desc = $request->meta_description;
        $slide->updated_at = Carbon::now();

        $slide->save();

        Session::flash('success', 'Cập nhật ảnh slide thành công.');

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
        $slide = Slide::find(request()->id);
        $slide->delete();
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $slide = Slide::find($data['id']);
        if($data['name'] == 'publish') {
            $slide->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $slide->sort_order = $data['value'];
        }
        $slide->updated_at = Carbon::now();
        $slide->save();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);

        foreach ($ids as $id) {
            if($id != '') {
                $slide = Slide::find($id);
                $slide->delete();
            }
        }
    }
}

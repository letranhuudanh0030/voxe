<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.video.index')->with('title_page', 'Danh sách video')
                                        ->with('create_page', 'videos.create')
                                        ->with('list_page', 'videos.index')
                                        ->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create')->with('title_page', 'Danh sách video')
                                            ->with('create_page', 'videos.create')
                                            ->with('list_page', 'videos.index');
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
            'title' => 'required|unique:videos',
            'link' => 'required'
        ]);

        Video::create([
            'title' => $request->title,
            'link' => $request->link,
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description
        ]);

        Session::flash('success', 'Thêm video thành công.');

        if($request->close) {
            return redirect()->route('videos.index');
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
        $video = Video::find($id);
        return view('admin.video.edit')->with('title_page', 'Danh sách video')
                                        ->with('create_page', 'videos.create')
                                        ->with('list_page', 'videos.index')
                                        ->with('video', $video);
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
            'link' => 'required'
        ]);

        $video = Video::find($id);

        $video->title = $request->title;
        $video->link = $request->link;
        $video->publish = $request->publish;
        $video->meta_title = $request->meta_title;
        $video->meta_keyword = $request->meta_keywords;
        $video->meta_desc = $request->meta_description;
        $video->updated_at = Carbon::now();
        $video->save();

        Session::flash('success', 'Cập nhật video thành công.');

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
        $video = Video::find(request()->id);
        $video->delete();
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $video = Video::find($data['id']);
        if($data['name'] == 'publish') {
            $video->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $video->sort_order = $data['value'];
        }
        $video->updated_at = Carbon::now();
        $video->save();
    }
}

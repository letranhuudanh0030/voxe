<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuLocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuLocations = MenuLocation::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.menuLocation.index')->with('title_page', 'Vị trí menu')
                                        ->with('create_page', 'menu-location.create')
                                        ->with('list_page', 'menu-location.index')
                                        ->with('menuLocations', $menuLocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menuLocation.create')->with('title_page', 'Thêm vị trí menu')
                                        ->with('create_page', 'menu-location.create')
                                        ->with('list_page', 'menu-location.index');
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
            'title' => 'required'
        ]);

        $keyword = null;
        if($request->keyword) {
            $keyword = $request->keyword;
        } else {
            $keyword = Str::slug($request->title, '-');
        }


        MenuLocation::create([
            'title' => $request->title,
            'keyword' => $keyword,
            'publish' => $request->publish,
            'user_name' => Auth::user()->name
        ]);

        $request->session()->flash('success', 'Thêm vị trí danh mục thành công.');

        if($request->close) {
            return redirect()->route('menu-location.index');
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
        $menuLocation = MenuLocation::findOrFail($id);
        return view('admin.menuLocation.edit')->with('title_page', 'Thêm vị trí menu')
                                        ->with('create_page', 'menu-location.create')
                                        ->with('list_page', 'menu-location.index')
                                        ->with('menuLocation', $menuLocation);
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
            'title' => 'required'
        ]);

        $keyword = null;
        if($request->keyword) {
            $keyword = $request->keyword;
        } else {
            $keyword = Str::slug($request->title, '-');
        }
        $menuLocation = MenuLocation::findOrFail($id);
        $menuLocation->title = $request->title;
        $menuLocation->keyword = $keyword;
        $menuLocation->publish = $request->publish;
        $menuLocation->updated_at = Carbon::now();
        $menuLocation->save();

        Session::flash('success', 'Cập nhật vị trí menu thành công.');

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

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $menu = MenuLocation::find($data['id']);
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
        $menu = MenuLocation::find(request()->id);
        $menu->delete();
    }

    public function search($id = null)
    {
        $menus = Menu::orderBy('created_at', 'desc')->where('location_id', $id)->paginate(12);
        return view('admin.menu.index')->with('title_page', 'Menu')
                                        ->with('create_page', 'menus.create')
                                        ->with('list_page', 'menus.index')
                                        ->with('menus', $menus);
    }

    public function searchLocation()
    {
        $menuLocations = menuLocation::orderBy('created_at', 'desc')->where('title', 'like', '%' . request()->search_name . '%')->paginate(12);
        return view('admin.menuLocation.index')->with('title_page', 'Menu')
                                        ->with('create_page', 'menu-location.create')
                                        ->with('list_page', 'menu-location.index')
                                        ->with('menuLocations', $menuLocations);
    }
}

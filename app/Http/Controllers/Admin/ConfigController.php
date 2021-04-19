<?php

namespace App\Http\Controllers\Admin;

use App\ConfigContact;
use App\ConfigGeneral;
use App\Display;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\Social;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{

    public function general()
    {
        $configGeneral = ConfigGeneral::first();
        return view('admin.config.general')->with('title_page', 'Cấu hình')
                                            ->with('configGeneral', $configGeneral);
    }

    public function postGeneral()
    {
        // dd(request()->all());
        $configGeneral = ConfigGeneral::findOrFail(request()->id);
        $configGeneral->name = request()->name;
        $configGeneral->slogan = request()->slogan;
        $configGeneral->meta_title = request()->meta_title;
        $configGeneral->meta_desc = request()->meta_desc;
        $configGeneral->meta_keyword = request()->meta_keyword;
        $configGeneral->phone = request()->phone;
        $configGeneral->address = request()->address;
        $configGeneral->copyright = request()->copyright;
        $configGeneral->logo = str_replace(url('/'),'',request()->logo);
        $configGeneral->updated_at = Carbon::now();

        $configGeneral->save();

        Session::flash('success', 'Cập nhật thông tin website thành công.');

        return redirect()->back();

    }


    public function display()
    {
        $display = Display::first();

        $color_menu = explode(';', $display->color_menu);
        $color_footer = explode(';', $display->color_footer);
        $color_copyright = explode(';', $display->color_copyright);
        return view('admin.config.display')->with('title_page', 'Cấu hình')
                                            ->with('display', $display)
                                            ->with('color_menu', $color_menu)
                                            ->with('color_footer', $color_footer)
                                            ->with('color_copyright', $color_copyright);
    }

    public function postDisplay($id)
    {

        $color_menu = request()->menu_bg . ';' . request()->menu_bg_hover . ';' . request()->menu_color . ';' . request()->menu_color_hover;
        $color_footer = request()->footer_bg . ';' . request()->footer_color . ';' . request()->footer_color_hover;
        $color_copyright = request()->copyright_bg . ';' . request()->copyright_color;

        $display = Display::find($id);
        $display->header_image = str_replace(url('/'),'',request()->header_image);
        $display->favicon = str_replace(url('/'),'',request()->favicon);
        $display->banner_clock = str_replace(url('/'),'',request()->clock_banner);
        $display->banner_page = str_replace(url('/'),'',request()->page_banner);
        $display->color_menu = $color_menu;
        $display->color_footer = $color_footer;
        $display->color_copyright = $color_copyright;
        $display->save();

        Session::flash('success', 'Cập nhật giao diện thành công.');
        return redirect()->back();

    }


    public function social()
    {
        $socials = Social::all();
        return view('admin.config.social')->with('title_page', 'Cấu hình')
                                            ->with('socials', $socials);
    }

    public function postSocial(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required'
        ]);

        Social::create([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon
        ]);

        Session::flash('success', 'Thêm mạng xã hội thành công.');

        return redirect()->back();
    }


    public function updateSocial()
    {
        $social = Social::findOrFail(request()->id);
        $social->name = request()->name;
        $social->link = request()->link;
        $social->icon = request()->icon;
        $social->updated_at = Carbon::now();
        $social->save();

        return response($social, 200);
    }

    public function removeSocial()
    {
        $social = Social::find(request()->id);
        $social->delete();
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $social = Social::find($data['id']);
        if($data['name'] == 'publish') {
            $social->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $social->sort_order = $data['value'];
        }
        $social->updated_at = Carbon::now();
        $social->save();
    }



    public function contact()
    {
        $configContact = ConfigContact::first();
        return view('admin.config.contact')->with('title_page', 'Cấu hình')
                                            ->with('configContact', $configContact);
    }

    public function postContact($id)
    {
        $contact = ConfigContact::find($id);
        // dd(request()->language);

        $contact->footer = request()->config_contact_footer;
        $contact->contact_page = request()->config_contact_page;
        $contact->support = request()->config_content_support;
        $contact->email_name = request()->email_name;
        $contact->email_rece = request()->email_receive;
        $contact->work_footer = request()->config_work_footer;
        $contact->commit_footer = request()->config_commit_footer;
        $contact->updated_at = Carbon::now();
        $contact->save();

        $data_pivot = [];
        if (request()->language) {
            for ($i=0; $i < count(request()->language); $i++) {
                $data_pivot[request()->language[$i]] = [
                    'footer' => request()->config_contact_footer_lang[$i],
                    'work_footer' => request()->config_work_footer_lang[$i],
                    'commit_footer' => request()->config_commit_footer_lang[$i],
                    'contact_page' => request()->config_contact_page_lang[$i],
                    'support' => request()->config_content_support_lang[$i],
                ];
            }

        } 
        $contact->language()->sync($data_pivot);

        Session::flash('success', 'Cập nhật thông tin thành công.');

        return redirect()->back();

    }


    public function language()
    {
        $languages = Language::all();
        return view('admin.config.language')->with('title_page', 'Cấu hình')
                                            ->with('languages', $languages);
    }

    public function postLanguage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required'
        ]);

        Language::create([
            'name' => $request->name,
            'name_code' => $request->code,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image)
        ]);

        Session::flash('success', 'Thêm ngôn ngữ thành công.');
        return redirect()->back();
    }


    public function updateLanguage()
    {

        $lang = Language::findOrFail(request()->id);
        $lang->name = request()->name;
        $lang->name_code = request()->link;
        $lang->avatar_image = str_replace(url('/'),'',request()->icon);
        $lang->updated_at = Carbon::now();
        $lang->save();

        return response($lang, 200);
    }

    public function removeLanguage()
    {
        $lang = Language::find(request()->id);
        $lang->delete();
    }

    public function updateLanguageStatus()
    {
        $data = request()->all();
        $lang = Language::find($data['id']);
        if($data['name'] == 'publish') {
            $lang->publish = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $lang->sort_order = $data['value'];
        }
        $lang->updated_at = Carbon::now();
        $lang->save();
    }

    public function sitemap()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('sitemap:create');
        return redirect(url('/sitemap.xml'));
    }
}

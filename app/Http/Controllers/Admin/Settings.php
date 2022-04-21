<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\Repo\Admin\SettingRepo;
use File;
use Lang;

class Settings extends Controller
{
    



    public function generalSetting(){
        $data['data'] = Setting::get();
        $data['title'] = 'setting';
        $data['createPath'] = url('admin/Setting/viewCreateSetting');
        $data['deletePath'] = url('admin/Setting/deleteManySettings');
        
        return view('Admin/Settings/generalSetting',$data);
    }




    public function viewCreateSetting($id = false){
        $data['data'] = Setting::first();
        return view('Admin/Settings/viewCreateSetting',$data);
    }




    public function createSetting(Request $request){

        $validated = $request->validate(SettingRepo::SettingCreateValidate());
        $destinationPath = public_path('Admin_uploads/settings/');

        $setting = Setting::first();
        if (empty($setting)) {
            if ($request->hasFile('siteImage')) {
                $validated['siteImage'] = SettingRepo::imageHandle($request->file('siteImage'),$destinationPath);
            }
            if ($request->hasFile('siteLogo')) {
                $validated['siteLogo'] = SettingRepo::imageHandle($request->file('siteLogo'),$destinationPath);
            }
            Setting::create($validated);
            session()->flash('warning',Lang::get('leftsidebar.Created'));
        }else{
            
            $validated['siteImage'] = $setting->siteImage;
            $validated['siteLogo'] = $setting->siteLogo;

            if ($request->hasFile('siteImage')) {
                File::delete($destinationPath . $validated['siteImage']);
                $validated['siteImage'] = SettingRepo::imageHandle($request->file('siteImage'),$destinationPath);
            }

            if ($request->hasFile('siteLogo')) {
                File::delete($destinationPath . $validated['siteLogo']);
                $validated['siteLogo'] = SettingRepo::imageHandle($request->file('siteLogo'),$destinationPath);
            }
            Setting::where('id',$setting->id)->update($validated);
            session()->flash('warning',Lang::get('leftsidebar.Updated'));
        }
        return redirect('admin/Setting/generalSetting');
    }



    public function deleteSetting($id){
        $setting =Setting::where('id',$id)->first();
        $destinationPath = public_path('Admin_uploads/settings/');                 
        File::delete($destinationPath . $setting->siteImage );
        File::delete($destinationPath . $setting->siteLogo );
        $setting->delete();
        session()->flash('warning',Lang::get('leftsidebar.Deleted'));
        return back();
    }




    public function deleteManySettings($ids){
        $ids = json_decode($ids);
        $data = Setting::whereIn('id',$ids)->get();
        $destinationPath = public_path('Admin_uploads/settings/');                 
        foreach($data as $dataa){
            File::delete($destinationPath . $dataa->siteImage );
            File::delete($destinationPath . $dataa->siteLogo );
            $dataa->delete();
        }
        session()->flash('warning','Done');
        return back();
    }







}

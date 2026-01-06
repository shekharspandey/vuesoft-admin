<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\SiteModel;
use Carbon\Carbon;
use Str;

class SiteController extends Controller
{
    private function loadview($view, $data = [])
    {
        $data['design_services'] = SiteModel::getAllHeaderServices("Design Solutions");
        $data['web_services'] = SiteModel::getAllHeaderServices("Web Solutions");
        $data['mobile_services'] = SiteModel::getAllHeaderServices("Mobile Solutions");
        $data['seo_services'] = SiteModel::getAllHeaderServices("SEO Services");
        $data['digital_services'] = SiteModel::getAllHeaderServices("Digital Marketing");
        $data['web_technologies'] = SiteModel::getAlltechnolgiesByCategory("Web");
        $data['mobile_technologies'] = SiteModel::getAlltechnolgiesByCategory("Mobile");
        $data['cloud_technologies'] = SiteModel::getAlltechnolgiesByCategory("Cloud");
        return view("site/$view", $data);
    }

    public function login()
    {
        $data['title'] = "VueSoft Admin - Login Account";
        // $data['services'] = SiteModel::getAllServices()->random(5);
        return $this->loadview('signin', $data);
    }

    public function signin(Request $request)
    {
        return redirect()->route('dashboard');
    }

    public function register()
    {
        $data['title'] = "VueSoft Admin - Create Account";
        // $data['services'] = SiteModel::getAllServices()->random(5);
        return $this->loadview('signup', $data);
    }

    public function signup(Request $request)
    {
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        $data['title'] = "VueSoft Admin - Forgot Password";
        // $data['services'] = SiteModel::getAllServices()->random(5);
        return $this->loadview('forgot_password', $data);
    }

    public function dashboard()
    {
        $data['title'] = "VueSoft Admin - Dashboard";
        return $this->loadview('dashboard', $data);
    }

    public function users()
    {
        $data['title'] = "VueSoft Admin - Users";
        return $this->loadview('users', $data);
    }

    public function services()
    {
        $data['title'] = "VueSoft Admin - Services";
        return $this->loadview('services', $data);
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\SiteModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public function profile()
    {
        $data['title'] = "VueSoft Admin - Profile";
        $data['user'] = DB::table('admins')->where('id', 1)->first();
        return $this->loadview('profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $admin = DB::table('admins')->where('id', 1)->first();

        $filename = $admin->profile_image;

        if ($request->hasFile('profile_image')) {

            // if ($filename) {
            //     Storage::delete('public/profile/' . $filename);
            // }

            $filename = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            // dd($filename);
            $request->file('profile_image')->storeAs('public/profile', $filename);
        }

        DB::table('admins')
            ->where('id', 1)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_image' => $filename,
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function changePassword()
    {
        $data['title'] = "VueSoft Admin - Change Password";
        return $this->loadview('change_password', $data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = DB::table('admins')->where('id', 1)->first();

        if (!Hash::check($request->input('current_password'), $admin->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        DB::table('admins')
            ->where('id', 1)
            ->update([
                'password' => Hash::make($request->input('password')),
            ]);

        return response()->json(['message' => 'Password updated']);
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

    public function usersData(Request $request)
    {
        return DataTables::of(DB::table('users'))
            ->addColumn('checkbox', function ($user) {
                return '<input type="checkbox"
                class="rowCheckbox h-4 w-4 rounded border-gray-300 accent-primary"
                value="' . $user->id . '">';
            })

            ->addColumn('user', function ($user) {
                $joined = $user->created_at
                    ? Carbon::parse($user->created_at)->format('M d, Y')
                    : '—';

                return '
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            ' . strtoupper(substr($user->name, 0, 1)) . '
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">' . $user->name . '</p>
                        <p class="text-xs text-gray-400">Joined ' . $joined . '</p>
                    </div>
                </div>
            ';
            })

            ->addColumn('role', fn($user) => '
            <span class="inline-flex rounded-full bg-blue-500/15 px-3 py-1 text-xs font-medium text-blue-500">
                ' . ($user->role ?? 'User') . '
            </span>
        ')

            ->addColumn('status', fn() => '
            <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-medium text-emerald-500">
                Active
            </span>
        ')

            ->addColumn('action', fn($user) => '
            <button
                onclick="window.location.href=\'' . route('userDetails', encryptID($user->id)) . '\'"
                class="px-3 py-2 hover:bg-gray-200 dark:hover:bg-gray-900 rounded-lg">
                <i class="bi bi-eye"></i>
            </button>
            <button onclick=\'openEditUser(' . json_encode($user) . ')\' class="px-3 py-2 hover:bg-gray-200 dark:hover:bg-gray-900 rounded-lg"><i class="bi bi-pencil"></i></button>
            <button class="px-3 py-2 text-red-500 hover:bg-gray-200 dark:hover:bg-gray-900 rounded-lg"><i class="bi bi-trash"></i></button>
        ')
            ->rawColumns(['checkbox', 'user', 'role', 'status', 'action'])
            ->make(true);
    }

    public function userDetails($id)
    {
        $data['title'] = "VueSoft Admin - User Details";
        $data['user'] = DB::table('users')->where('id', decryptID($id))->first();
        return $this->loadview('user_details', $data);
    }

    public function services()
    {
        $data['title'] = "VueSoft Admin - Services";
        return $this->loadview('services', $data);
    }

    public function faqs()
    {
        $data['title'] = "VueSoft Admin - FAQs";
        return $this->loadview('faqs', $data);
    }

    public function faqsData(Request $request)
    {
        return DataTables::of(DB::table('faqs'))
            ->addIndexColumn()

            ->addColumn('question', function ($faq) {
                return strip_tags($faq->question);
            })

            ->addColumn('answer', function ($faq) {
                return strip_tags($faq->answer);
            })

            ->addColumn('category', function ($faq) {
                return $faq->category
                    ? '<span class="inline-flex rounded-full bg-indigo-500/15 px-3 py-1 text-xs font-medium text-indigo-500">'
                    . $faq->category .
                    '</span>'
                    : '—';
            })

            ->addColumn('created_at', function ($faq) {
                return strip_tags($faq->created_at);
            })

            ->addColumn('status', function ($faq) {
                if ($faq->status) {
                    return '
                    <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-medium text-emerald-500">
                        Active
                    </span>
                ';
                }

                return '
                <span class="inline-flex rounded-full bg-red-500 px-3 py-1 text-xs font-medium text-white">
                    Inactive
                </span>
            ';
            })

            ->addColumn('action', function ($faq) {
                return '
                <button
                    onclick=\'openEditFaq(' . json_encode($faq) . ')\'
                    class="px-3 py-2 hover:bg-gray-200 dark:hover:bg-gray-900 rounded-lg">
                    <i class="bi bi-pencil"></i>
                </button>

                <button
                    onclick="deleteFaq(' . $faq->id . ')"
                    class="px-3 py-2 text-red-500 hover:bg-gray-200 dark:hover:bg-gray-900 rounded-lg">
                    <i class="bi bi-trash"></i>
                </button>
            ';
            })

            ->rawColumns([
                'checkbox',
                'question',
                'category',
                'status',
                'action'
            ])
            ->make(true);
    }

    public function privacyPolicy()
    {
        $data = DB::table('static_pages')
            ->where('slug', 'privacy-policy')
            ->first();

        return $this->loadview('privacy_policy', $data);
    }

    public function savePrivacyPolicy(Request $request)
    {
        DB::table('static_pages')->updateOrInsert(
            [
                'title' => $request->input('title'),
                'language' => $request->input('language'),
                'content' => $request->input('content'),
                'updated_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    }

    public function terms()
    {
        $data['title'] = "VueSoft Admin - Terms and Conditions";
        return $this->loadview('terms', $data);
    }
}

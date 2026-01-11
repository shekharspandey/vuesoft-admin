<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\SiteModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $admin = DB::table('admins')
            ->where('email', $request->input('email'))
            ->where('status', 'Active')
            ->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Admin not found']);
        }

        if (!Hash::check($request->input('password'), $admin->password)) {
            return back()->withErrors(['email' => 'Wrong password']);
        }

        $request->session()->regenerate();

        $sessionToken = hash('sha256', Str::uuid()->toString());

        $agent = new Agent();

        DB::table('admin_sessions')->insert([
            'admin_id' => $admin->id,
            'session_token' => $sessionToken,
            'device_type' => $agent->isMobile() ? 'mobile' : 'desktop',
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'ip_address' => $request->ip(),
            'logged_in_at' => now(),
            'is_active' => true,
        ]);

        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_session_token' => $sessionToken,
        ]);

        DB::table('admins')
            ->where('id', $admin->id)
            ->update(['current_session_id' => $sessionToken, 'last_login_at' => now()]);

        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_info' => $admin,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $adminId = session('admin_id');

        $admin = DB::table('admins')->where('id', $adminId)->first();

        DB::table('admins')
            ->where('id', $adminId)
            ->update([
                'current_session_id' => null,
                'last_logout_at' => now(),
            ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register()
    {
        $data['title'] = "VueSoft Admin - Create Account";
        // $data['services'] = SiteModel::getAllServices()->random(5);
        return $this->loadview('signup', $data);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:191|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::table('admins')->insert([
            'name' => trim($request->first_name . ' ' . $request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
            'password_updated_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
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
        $data['user'] = DB::table('admins')->where('id', session('admin_id'))->first();
        return $this->loadview('profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $adminId = session('admin_id');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $adminId,
            'profile_image' => 'nullable|image|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $admin = DB::table('admins')->where('id', $adminId)->first();
        $filename = $admin->profile_image;

        if ($request->hasFile('profile_image')) {

            if ($filename && Storage::disk('public')->exists('profile/' . $filename)) {
                Storage::disk('public')->delete('profile/' . $filename);
            }

            $filename = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->storeAs('profile', $filename, 'public');
        }

        DB::table('admins')->where('id', $adminId)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
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
        $adminId = session('admin_id');

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $admin = DB::table('admins')->where('id', $adminId)->first();

        // ❌ Current password wrong
        if (!Hash::check($request->input('current_password'), $admin->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        // ❌ Same as old password
        if (Hash::check($request->input('password'), $admin->password)) {
            return response()->json([
                'message' => 'New password must be different from current password'
            ], 422);
        }

        DB::table('admins')
            ->where('id', $adminId)
            ->update([
                'password' => Hash::make($request->input('password')),
                'password_updated_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Saved successfully!');
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

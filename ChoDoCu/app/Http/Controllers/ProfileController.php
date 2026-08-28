<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $listings = Listing::where('user_id', $user->id)
            ->with('primaryImage')
            ->latest()
            ->get();
        $publishedListings = Listing::where('user_id', $user->id)
    ->where('status', 'published')
    ->with('primaryImage')
    ->latest()
    ->get();


$soldListings = Listing::where('user_id', $user->id)
    ->where('status', 'sold')
    ->with('primaryImage')
    ->latest()
    ->get();


$hiddenListings = collect();

if (auth()->check() && auth()->id() === $user->id) {

    $hiddenListings = Listing::where('user_id', $user->id)
        ->where('status', 'hidden')
        ->with('primaryImage')
        ->latest()
        ->get();
}
        return view('profile.show', compact(
            'user',
            'listings',
             'publishedListings',
    'soldListings',
    'hiddenListings'
        ));
    }
    public function edit()
{
    $user = auth()->user();

    return view('profile.edit', compact('user'));
}
public function show(User $user)
{
    $listings = $user->listings()
        ->where('status', 'published')
        ->with('primaryImage')
        ->latest()
        ->get();

    return view('profile.show', compact('user', 'listings'));
}
public function update(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20',
        ],

        'address' => [
            'nullable',
            'string',
            'max:255',
        ],

        'bio' => [
            'nullable',
            'string',
            'max:300',
        ],

        'avatar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:5120',
        ],
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | CẬP NHẬT AVATAR NẾU CÓ ẢNH MỚI
        |--------------------------------------------------------------------------
        */

        $avatarUrl = $user->avatar;

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            $path = Storage::disk('cloudinary')->putFile(
                'chodocu/avatars/' . $user->id,
                $avatar
            );

            $avatarUrl = Storage::disk('cloudinary')->url($path);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        $user->update([
            'name' => $validated['name'],

            'phone' => $validated['phone'] ?? null,

            'address' => $validated['address'] ?? null,

            'bio' => $validated['bio'] ?? null,

            'avatar' => $avatarUrl,
        ]);


        DB::commit();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Cập nhật hồ sơ thành công!'
            );

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return back()
            ->withInput()
            ->withErrors([
                'profile' => $e->getMessage(),
            ]);
    }
}
public function updatePassword(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'current_password' => [
            'required',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'max:32',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'confirmed',
        ],
    ], [
        'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',

        'password.required' => 'Vui lòng nhập mật khẩu mới.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.max' => 'Mật khẩu tối đa 32 ký tự.',
        'password.regex' => 'Mật khẩu phải có chữ hoa, chữ thường và chữ số.',
        'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
    ]);


    // Kiểm tra mật khẩu hiện tại
    if (!Hash::check(
        $validated['current_password'],
        $user->password
    )) {

        return back()
            ->withErrors([
                'current_password' => 'Mật khẩu hiện tại không chính xác.',
            ])
            ->withInput();
    }


    // Không cho dùng lại mật khẩu cũ
    if (Hash::check(
        $validated['password'],
        $user->password
    )) {

        return back()
            ->withErrors([
                'password' => 'Mật khẩu mới không được giống mật khẩu hiện tại.',
            ])
            ->withInput();
    }


    // Update password
    $user->update([
        'password' => Hash::make(
            $validated['password']
        ),
    ]);


    return back()->with(
        'password_success',
        'Đổi mật khẩu thành công!'
    );
}


}
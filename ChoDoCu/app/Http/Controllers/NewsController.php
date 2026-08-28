<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class NewsController extends Controller
{
    public function index(){
        $categories = Category::whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();
        return view('/news/createnews',compact('categories'));
    }
    public function create()
{
    $categories = Category::whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('createnews', compact('categories'));
}
public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => [
            'required',
            'exists:categories,id',
        ],

        'title' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'required',
            'string',
            'max:1500',
        ],

        'condition' => [
            'required',
            'in:new,used',
        ],

        'price' => [
            'required',
            'numeric',
            'min:0',
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20',
        ],

        'province' => [
            'nullable',
            'string',
            'max:255',
        ],

        'district' => [
            'nullable',
            'string',
            'max:255',
        ],

        'ward' => [
            'nullable',
            'string',
            'max:255',
        ],

        'address' => [
            'nullable',
            'string',
            'max:255',
        ],

        'images' => [
            'required',
            'array',
            'min:1',
            'max:6',
        ],

        'images.*' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:10240',
        ],
    ]);

    DB::beginTransaction();

    try {

        // =========================
        // TẠO SLUG
        // =========================

        $slug = Str::slug($validated['title']);

        if (Listing::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }


        // =========================
        // TẠO LISTING
        // =========================

        $listing = Listing::create([
            'user_id' => auth()->id(),

            // Đây là category cuối cùng:
            // iPhone / Samsung / Xiaomi...
            // hoặc category cha nếu không có category con
            'category_id' => $validated['category_id'],

            'title' => $validated['title'],
            'slug' => $slug,

            'description' => $validated['description'],

            'price' => $validated['price'],

            'is_negotiable' => $request->boolean('is_negotiable'),

            'condition' => $validated['condition'],

            'province' => $validated['province'] ?? null,
            'district' => $validated['district'] ?? null,
            'ward' => $validated['ward'] ?? null,
            'address' => $validated['address'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'status' => 'published',

            'views' => 0,

            'published_at' => now(),
        ]);


        // =========================
        // UPLOAD ẢNH CLOUDINARY
        // =========================

        foreach ($request->file('images') as $index => $image) {

            $path = Storage::disk('cloudinary')->putFile(
                'chodocu/listings/' . $listing->id,
                $image
            );

            $imageUrl = Storage::disk('cloudinary')->url($path);

            ListingImage::create([
                'listing_id' => $listing->id,

                'image_path' => $imageUrl,

                // ảnh đầu tiên làm ảnh đại diện
                'is_primary' => $index === 0 ? 1 : 0,

                'sort_order' => $index + 1,
            ]);
        }


        // =========================
        // COMMIT
        // =========================

        DB::commit();


        // =========================
        // CHUYỂN SANG TRANG CHI TIẾT
        // =========================

        return redirect()
            ->route('listings.show', $listing->slug)
            ->with(
                'success',
                'Đăng tin thành công!'
            );

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return back()
            ->withInput()
            ->withErrors([
                'upload' => $e->getMessage(),
            ]);
    }
}
public function edit(Listing $listing)
{
    // Chỉ chủ tin mới được sửa
    abort_if($listing->user_id !== auth()->id(), 403);

    $listing->load('images');

    $categories = Category::whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $selectedCategory = Category::find($listing->category_id);

    $parentCategoryId = $selectedCategory?->parent_id
        ?? $selectedCategory?->id;

    $subCategories = Category::where(
            'parent_id',
            $parentCategoryId
        )
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('news.edit', compact(
        'listing',
        'categories',
        'subCategories',
        'parentCategoryId'
    ));
}
public function update(Request $request, Listing $listing)
{
    // Chỉ chủ tin mới được sửa
    abort_if($listing->user_id !== auth()->id(), 403);

    $validated = $request->validate([
        'category_id' => [
            'required',
            'exists:categories,id',
        ],

        'title' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'required',
            'string',
            'max:1500',
        ],

        'condition' => [
            'required',
            'in:new,used',
        ],

        'price' => [
            'required',
            'numeric',
            'min:0',
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20',
        ],

        // ==========================
        // ĐỊA CHỈ
        // ==========================

        'province' => [
            'nullable',
            'string',
            'max:255',
        ],

        'district' => [
            'nullable',
            'string',
            'max:255',
        ],

        'ward' => [
            'nullable',
            'string',
            'max:255',
        ],

        'address' => [
            'nullable',
            'string',
            'max:255',
        ],

        // ==========================
        // ẢNH
        // ==========================

        'images' => [
            'nullable',
            'array',
            'max:6',
        ],

        'images.*' => [
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:10240',
        ],

        'deleted_images' => [
            'nullable',
            'array',
        ],

        'deleted_images.*' => [
            'integer',
            'exists:listing_images,id',
        ],
        'status' => [
    'required',
    'in:published,hidden,sold',
],
    ]);


    DB::beginTransaction();

    try {

        // ==========================
        // UPDATE THÔNG TIN TIN ĐĂNG
        // ==========================

        $listing->update([
            'category_id' => $validated['category_id'],

            'title' => $validated['title'],

            'description' => $validated['description'],

            'condition' => $validated['condition'],

            'price' => $validated['price'],

            'phone' => $validated['phone'] ?? null,
            
            'status' => $validated['status'],
            // ĐỊA CHỈ
            'province' => $validated['province'] ?? null,
            'district' => $validated['district'] ?? null,
            'ward' => $validated['ward'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);


        // ==========================
        // XÓA ẢNH CŨ
        // ==========================

        if (!empty($validated['deleted_images'])) {

            $imagesToDelete = ListingImage::where(
                    'listing_id',
                    $listing->id
                )
                ->whereIn(
                    'id',
                    $validated['deleted_images']
                )
                ->get();

            foreach ($imagesToDelete as $image) {
                $image->delete();
            }
        }


        // ==========================
        // UPLOAD ẢNH MỚI
        // ==========================

        if ($request->hasFile('images')) {

            $currentCount = $listing->images()->count();

            foreach ($request->file('images') as $index => $image) {

                $path = Storage::disk('cloudinary')
                    ->putFile(
                        'chodocu/listings/' . $listing->id,
                        $image
                    );

                $imageUrl = Storage::disk('cloudinary')
                    ->url($path);

                ListingImage::create([
                    'listing_id' => $listing->id,

                    'image_path' => $imageUrl,

                    'is_primary' =>
                        $currentCount === 0 && $index === 0
                            ? 1
                            : 0,

                    'sort_order' =>
                        $currentCount + $index + 1,
                ]);
            }
        }


        DB::commit();


        return redirect()
            ->route('listings.manage')
            ->with(
                'success',
                'Cập nhật tin thành công!'
            );

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return back()
            ->withInput()
            ->withErrors([
                'update' => $e->getMessage(),
            ]);
    }
}
}
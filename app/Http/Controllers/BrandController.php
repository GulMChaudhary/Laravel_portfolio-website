<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|max:50|unique:brands',
            'brand_image' => 'required|mimes:jpeg,gif,jpeg,png',
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/brand/';
        $last_image = $upload_location . $image_name;
        $brand_image->move($upload_location, $image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()

        ]);

        return redirect()->back()->with('success', 'Brand added successfully.');
    }
    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'max:50',
            'brand_image' => 'mimes:jpeg,gif,jpeg,png'
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $img_ext;
            $upload_location = 'images/brand/';
            $last_image = $upload_location . $image_name;
            $brand_image->move($upload_location, $image_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_image,
                'user_id' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand data updated successfully.');
        } else {
            Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);
            return redirect()->back()->with('success', 'Brand data updated successfully.');
        }
    }

    public function destroy ($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted.');

    }

}

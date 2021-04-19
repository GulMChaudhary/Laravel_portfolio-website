<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
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

}

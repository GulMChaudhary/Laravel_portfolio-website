<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Auth;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:3',
            'slider_image'=>'mimes:png,jpg,gif,jpeg'
        ]);

        $slider_image = $request->file('slider_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($slider_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/slider/';
        $last_image = $upload_location . $image_name;
        $slider_image->move($upload_location, $image_name);

        Slider::insert([
            'title' =>  $request->title,
            'description' =>  $request->description,
            'slider_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Image Added');
    }

    
}

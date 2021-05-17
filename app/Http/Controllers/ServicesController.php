<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:150|unique:services',
            'description' => 'required|max:200',
            'icon' => 'required|mimes:jpeg,gif,jpeg,png',
        ]);

        $service_icon = $request->file('icon');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($service_icon->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/services/';
        $last_image = $upload_location . $image_name;
        $service_icon->move($upload_location, $image_name);

        Service::insert([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $last_image,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Service added successfully.');
    }

    public function edit($id)
    {
        $services = Service::find($id);
        return view('admin.services.edit', compact('services'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:150|unique:services',
            'description' => 'required|max:200',
            'icon' => 'required|mimes:jpeg,gif,jpeg,png',
        ]);

    }


    public function destroy ($id)
    {
        $image = Service::find($id);
        $old_image = $image->icon;
        unlink($old_image);

        Service::find($id)->delete();
        return redirect()->back()->with('success', 'Service Deleted.');

    }

}

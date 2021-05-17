<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutSection extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = HomeAbout::latest()->get();
        return view('admin.about_section.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about_section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->shortDescription,
            'long_description' => $request->longDescription,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('home.about')->with('success', 'About section content added successfully.');

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
        $about = HomeAbout::find($id);
        return view('admin.about_section.edit', compact('about'));
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
       $update =  HomeAbout::find($id)->update([
            'title'=>$request->title,
            'short_description' => $request->shortDescription,
            'long_description' => $request->longDescription,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('home.about')->with('success', 'About section content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return redirect()->back()->with('success', 'About section content deleted successfully.');
    }
}

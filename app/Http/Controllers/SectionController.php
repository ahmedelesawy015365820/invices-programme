<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view("section.sections", compact("sections"));
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
    public function store(SectionRequest $request)
    {

        Section::create([
            "section_name" => $request->section_name,
            "discrption" => $request->discrption,
            "creat_by" => (Auth::user()->name)
        ]);

        return redirect()->back()->with(["success" => " تمت الاضافه بنجاح"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request)
    {
        $id = Section::find($request->id);

        if(!$id)
            return redirect()->back()->with(["error" => "هذا القسم غير موجود"]);

        $id->update([
            "section_name" => $request->section_name,
            "discrption" => $request->discrption,
        ]);

        return redirect()->back()->with(["success" => "تم التعديل بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = Section::find($request->id);

        if(!$id)
            return redirect()->back()->with(["error" => "هذا القسم غير موجود"]);

        $id->delete();

        return redirect()->back()->with(["error" => "تم الحذف بنجاح"]);

    }
}

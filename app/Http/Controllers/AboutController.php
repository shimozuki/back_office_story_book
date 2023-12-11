<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutModels;

class AboutController extends Controller
{
    public function index()
    {
        $data = AboutModels::all();

        return view('admin.About.list', compact('data'));
    }

    public function create()
    {
        return view('admin.About.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi' => 'required',
            'image' => 'required',
        ]);
        $inputs = $request->all();

        if ($inputs['featured_image']) {
            $image_path = uploadWithThumb($inputs['featured_image'], 'images/blog');
            $inputs['featured_image'] = $image_path;
        }

        AboutModels::create($inputs);
        $request->session()->flash('success', 'Post Successfull!');

        return redirect("admin/posts");
    }
}

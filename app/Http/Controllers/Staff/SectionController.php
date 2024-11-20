<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Models\Section;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('staff.sections.index', ['sections' => Section::all()]);
    }

    public function create()
    {
        return view('staff.sections.create');
    }

    public function store(StoreSectionRequest $request)
    {
        $input = $request->all();
        $section = Section::create($input);
        return redirect()->route('sections.index')
            ->withSuccess('New section is added successfully.');
    }

    public function show()
    {
        //
    }

    public function edit(Section $section)
    {
        //dump($section);
        return view('staff.sections.edit', ['section' => $section]);
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        //
        $input = $request->all();
        $section->update($input);
        return redirect()->back()
            ->withSuccess('Section is updated successfully.');
    }

    public function destroy()
    {
        //
    }

}

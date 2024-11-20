<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workplace\StoreWorkplaceRequest;
use App\Http\Requests\Workplace\UpdateWorkplaceRequest;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkplaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('staff.workplaces.index', ['workplaces' => Workplace::all()]);
    }

    public function create()
    {
        return view('staff.workplaces.create');
    }

    public function store(StoreWorkplaceRequest $request)
    {
        $input = $request->all();
        $workplace = Workplace::create($input);
        return redirect()->route('workplaces.index')
            ->withSuccess('New workplace is added successfully.');
    }

    public function show()
    {
        //
    }

    public function edit(Workplace $workplace)
    {
        return view('staff.workplaces.edit', ['workplace' => $workplace]);
    }

    public function update(UpdateWorkplaceRequest $request, Workplace $workplace)
    {
        //
        $input = $request->all();
        $workplace->update($input);
        return redirect()->back()
            ->withSuccess('Workplace is updated successfully.');
    }

    public function destroy()
    {
        //
    }

}

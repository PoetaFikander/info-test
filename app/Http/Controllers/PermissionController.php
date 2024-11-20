<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-permission|edit-permission|delete-permission', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('permissions.index', [
            'permissions' => Permission::orderBy('id', 'ASC')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('permissions.create');
    }

    /**
     * Section a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $permission = Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->withSuccess('New permission is added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): View
    {
        return view('permissions.show', [
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->all());

        return redirect()->back()
            ->withSuccess('Permission is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        return redirect()->route('permissions.index')
            ->withSuccess('Usuwanie uprawnień do ogarnięcia');
    }
}

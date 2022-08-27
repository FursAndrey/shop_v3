<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionsRequest;
use App\Models\Property;
use App\Models\PropertyOption;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyOptions = PropertyOption::paginate(15);
        return view('admin.property_option.index', compact('propertyOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::get();
        return view('admin.property_option.form', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PropertyOptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyOptionsRequest $request)
    {
        $propertyOption = PropertyOption::create($request->all());
        return redirect()->route('property.index')->with('success', __('flushes.option_added', ['option' => $propertyOption->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyOption $propertyOption)
    {
        return view('admin.property_option.show', compact('propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyOption $propertyOption)
    {
        $properties = Property::get();
        return view(
            'admin.property_option.form', 
            [
                'propertyOption' => $propertyOption,
                'properties' => $properties,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PropertyOptionsRequest  $request
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyOptionsRequest $request, PropertyOption $propertyOption)
    {
        $propertyOption->update($request->all());
        return redirect()->route('property_option.index')->with('warning', __('flushes.option_updated', ['option' => $propertyOption->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property_option.index')->with('danger', __('flushes.option_deleted', ['option' => $propertyOption->name]));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function create_for_property(Property $property)
    {
        return view('admin.property_option.form_for_prop', compact('property'));
    }
}

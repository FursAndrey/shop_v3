<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::paginate(15);
        return view('admin.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->all());
        return redirect()->route('currency.index')->with('success', __('flushes.currency_added', ['currency' => $currency->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('admin.currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admin.currency.form', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyRequest  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());
        return redirect()->route('currency.index')->with('warning', __('flushes.currency_updated', ['currency' => $currency->code]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currency.index')->with('danger', __('flushes.currency_deleted', ['currency' => $currency->code]));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function resetProject()
    {
        Artisan::call('migrate:fresh --seed');

        $folder = 'uploads';
        $folder_reset = 'reset_img';
        Storage::disk('public')->deleteDirectory($folder);
        Storage::disk('public')->makeDirectory($folder);

        $files = Storage::disk('public')->files($folder_reset);
        foreach ($files as $file_name) {
            $contents = Storage::disk('public')->get($file_name);
            $file_name = str_replace($folder_reset, $folder, $file_name);
            Storage::disk('public')->put($file_name, $contents);
        }
        return redirect()->route('skuListPage')->with('success', __('flushes.resetProject'));
    }
}

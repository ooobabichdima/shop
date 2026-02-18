<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoPage;
use Illuminate\Http\Request;

class SeoPageController extends Controller
{
    public function index()
    {
        $pages = SeoPage::orderBy('page_name')->get();
        return view('admin.seo.index', compact('pages'));
    }

    public function edit(SeoPage $seoPage)
    {
        return view('admin.seo.edit', compact('seoPage'));
    }

    public function update(Request $request, SeoPage $seoPage)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $seoPage->update($validated);

        return back()->with('success', 'SEO налаштування оновлено');
    }
}

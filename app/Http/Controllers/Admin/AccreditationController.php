<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NursingPageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AccreditationController extends Controller
{
    public function edit(): View
    {
        return view('admin.accreditation.edit', [
            'section' => NursingPageSection::firstOrCreate(
                ['section_type' => 'accreditation'],
                ['eyebrow' => 'Accreditation & Recognition', 'title' => 'Choose a trusted pathway.', 'body' => '', 'icon_label' => 'shield', 'icon_labels' => ['shield', 'shield', 'shield'], 'sort_order' => 35, 'is_active' => true]
            ),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:180'],
            'body' => ['required', 'string', 'max:10000'],
            'icon_label' => ['nullable', 'string', 'max:24'],
            'icon_labels' => ['nullable', 'array', 'size:3'],
            'icon_labels.*' => ['nullable', 'string', 'max:24'],
            'icon_files' => ['nullable', 'array', 'size:3'],
            'icon_files.*' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['icon_labels'] = array_values($request->input('icon_labels', ['shield', 'shield', 'shield']));
        $section = NursingPageSection::where('section_type', 'accreditation')->first();
        $iconPaths = $section?->icon_paths ?: [null, null, null];
        foreach (range(0, 2) as $index) {
            if ($request->hasFile('icon_files.'.$index)) {
                if (!empty($iconPaths[$index]) && str_starts_with($iconPaths[$index], 'accreditation-icons/')) Storage::disk('public')->delete($iconPaths[$index]);
                $iconPaths[$index] = $request->file('icon_files.'.$index)->store('accreditation-icons', 'public');
            }
        }
        $validated['icon_paths'] = array_values($iconPaths);

        NursingPageSection::updateOrCreate(
            ['section_type' => 'accreditation'],
            array_merge($validated, ['sort_order' => 35])
        );

        return redirect()->route('admin.accreditation.edit')->with('status', 'Accreditation content updated successfully.');
    }
}

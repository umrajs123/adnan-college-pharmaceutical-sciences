<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AccreditationItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class AccreditationItemController extends Controller
{
    public function index(): View { return view('admin.accreditation.index', ['items' => AccreditationItem::orderBy('sort_order')->orderBy('id')->get()]); }
    public function create(): View { return view('admin.accreditation.item-edit', ['item' => new AccreditationItem(['sort_order' => (AccreditationItem::max('sort_order') ?? -1) + 1, 'is_active' => true]), 'isCreate' => true]); }
    public function store(Request $request): RedirectResponse { $item = AccreditationItem::create($this->validated($request)); $this->saveIcon($request, $item, null); return redirect()->route('admin.accreditation.index')->with('status','Accreditation item added.'); }
    public function edit(AccreditationItem $item): View { return view('admin.accreditation.item-edit', ['item' => $item, 'isCreate' => false]); }
    public function update(Request $request, AccreditationItem $item): RedirectResponse { $old = $item->icon_path; $item->update($this->validated($request)); $this->saveIcon($request, $item, $old); return redirect()->route('admin.accreditation.index')->with('status','Accreditation item updated.'); }
    public function destroy(AccreditationItem $item): RedirectResponse { if ($item->icon_path) Storage::disk('public')->delete($item->icon_path); $item->delete(); return back()->with('status','Accreditation item removed.'); }
    private function validated(Request $request): array { $data = $request->validate(['name'=>['required','string','max:180'],'description'=>['required','string','max:1000'],'logo_path'=>['nullable','string','max:700'],'icon'=>['nullable','image','max:2048'],'sort_order'=>['required','integer','min:0','max:999'],'is_active'=>['nullable','boolean']]); $data['is_active']=$request->boolean('is_active'); unset($data['icon']); return $data; }
    private function saveIcon(Request $request, AccreditationItem $item, ?string $old): void { if ($request->hasFile('icon')) { if ($old) Storage::disk('public')->delete($old); $item->update(['icon_path'=>$request->file('icon')->store('accreditation-icons','public')]); } }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class AccreditationItem extends Model
{
    protected $fillable = ['name','description','logo_path','icon_path','sort_order','is_active'];
    protected function casts(): array { return ['is_active' => 'boolean', 'sort_order' => 'integer']; }
    public function scopeActive(Builder $query): Builder { return $query->where('is_active', true); }
    public function logoUrl(): ?string { return $this->logo_path ? (str_starts_with($this->logo_path, 'http') ? $this->logo_path : asset($this->logo_path)) : null; }
    public function iconUrl(): ?string { return $this->icon_path ? asset('storage/'.$this->icon_path) : null; }
}

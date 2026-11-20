<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdmissionApplication extends Model {
    protected $fillable = ['reference', 'full_name', 'email', 'phone', 'program', 'qualification'];
}

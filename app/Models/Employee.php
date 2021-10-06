<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['firts_name','last_name'];
    protected $appends = ['full_name'];
    protected $with = ['company'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getFullNameAttribute()
    {
        return $this->firts_name . ' ' . $this->last_name;
    }

    public function scopeFilters($query, array $filters)
    {
        $dateFrom = $filters['date1'] ?? null;
        $dateTo = $filters['date2'] ?? null;
        //dd($dateTo);
        $query->when($dateFrom ?? false, function($query,$dateFrom)use($dateTo){
            return $query->whereBetween('created_at',[date($dateFrom),date($dateTo)]);
        });
        $query->when($filters['search'] ?? false, function($query,$search){
            return $query->where('email','like','%'.$search.'%')
                         ->orWhere('firts_name','like','%'.$search.'%')
                         ->orWhere('last_name','like','%'.$search.'%')
                         ->orWhereHas('company', function($query)use($search){
                             return $query->where('name','like','%'.$search.'%');
                         });
        });
    }
}

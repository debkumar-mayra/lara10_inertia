<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'active',
    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['question'] ?? null, function ($query, $search) {
            $query->where('question','like', "%" . trim($search) . "%");
        });

        $query->when($filters['answer'] ?? null, function ($query, $search) {
            $query->where('answer','like', "%" . trim($search) . "%");
        });

        $query->when($filters['created_at'] ?? null, function ($query, $search) {
            $date = date('Y-m-d',strtotime($search));
            $query->whereDate('created_at', '=', $date);
        });

        $query->when(isset($filters['active']) ?? null, function ($query, $search) use($filters){
            $query->where('active',$filters['active']);
        });
    }

    public function scopeOrdering($query, array $filters)
    {
        $query->when($filters['fieldName'] ?? null, function ($query, $search) use($filters){
            $query->orderBy($search,$filters['shortBy']);
        });
    }

}

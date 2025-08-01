<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;

    protected $table = 'company_services';

    protected $fillable = [
        'company_id',
        'parent_category_id',
        'sub_category_id',
        'title',
        'description',
        'price',
        'image',
        'status',
        'reads',
        'share',
        'like'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'parent_category_id');
    }

    public function subCategory() {
        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    protected $fillable = [

        'template_path',

        'name_x',
        'name_y',

        'category_x',
        'category_y',

        'number_x',
        'number_y',

        'name_color',
        'name_size',

        'category_color',
        'category_size',

        'number_color',
        'number_size',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
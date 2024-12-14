<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'EditionYear',
        'DOI',
        'PagesCount',
        'Status',
        'category_id',
    ];

    public function authors() {
        return $this->belongsToMany(Author::class, 'author_publications');
    }

    public function scientific_publication() {
        return $this->belongTo(ScientificPublication::class);
    }

    public function methodical_publication() {
        return $this->belongTo(MethodicalPublication::class);
    }
}

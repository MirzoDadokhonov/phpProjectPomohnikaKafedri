<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia; 
use Spatie\MediaLibrary\InteractsWithMedia; 

use Illuminate\Database\Eloquent\Model;

class Author extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    protected $fillable = [
        'FullName',
        'Email',
        'ORCID',
        'Role',
        'image',
    ];

    public function publications() {
        return $this->belongsToMany(Publication::class, 'author_publications');
    }

    public function registerMediaConvertions(Media $media = null) : void {
        $this->addMediaConvertion('thumb')
            ->width(200)->height(200);
    }
}

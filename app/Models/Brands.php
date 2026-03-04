<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Brands extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'logo'
    ];

    protected static function booted()
    {
        static::deleting(
            function ($brand) {
                if ($brand->logo && $brand->isForceDeleting()) {
                    Storage::disk('public')->delete($brand->logo);
                }
            }
        );

        static::updating(
            function($brand){
                if($brand->isDirty('logo')){
                    $oldLogo = $brand->getOriginal('logo');

                    if($oldLogo){
                        Storage::disk('public')->delete($oldLogo);
                    }
                }
            }
        );
    }
}

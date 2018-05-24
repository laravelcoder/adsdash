<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdType
 *
 * @package App
 * @property string $codec
 * @property string $extention
*/
class AdType extends Model
{
    protected $fillable = ['codec', 'extention'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Variable
 *
 * @package App
 * @property string $name
 * @property string $value
*/
class Variable extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'value'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}

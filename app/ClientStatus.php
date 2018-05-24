<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientStatus
 *
 * @package App
 * @property string $title
*/
class ClientStatus extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}

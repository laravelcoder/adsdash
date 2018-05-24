<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientProjectStatus
 *
 * @package App
 * @property string $title
*/
class ClientProjectStatus extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    
}

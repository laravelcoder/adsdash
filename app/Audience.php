<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Audience
 *
 * @package App
 * @property string $name
 * @property string $value
*/
class Audience extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'value'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    
    
    public function companies()
    {
        return $this->belongsToMany(ContactCompany::class, 'audience_contact_company');
    }
    
}

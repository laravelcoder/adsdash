<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactCompany
 *
 * @package App
 * @property string $name
 * @property string $website
 * @property string $email
 * @property string $logo
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
*/
class ContactCompany extends Model
{
    protected $fillable = ['name', 'website', 'email', 'logo', 'address', 'city', 'state', 'zipcode'];
    protected $hidden = [];
    public static $searchable = [
        'address',
        'city',
        'state',
        'zipcode',
    ];
    
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactCompany
 *
 * @package App
 * @property string $name
 * @property string $address
 * @property string $website
 * @property string $email
*/
class ContactCompany extends Model
{
    protected $fillable = ['name', 'address', 'website', 'email'];
    protected $hidden = [];
    
    
    
}

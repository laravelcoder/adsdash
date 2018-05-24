<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCurrency
 *
 * @package App
 * @property string $title
 * @property string $code
 * @property tinyInteger $main_currency
*/
class ClientCurrency extends Model
{
    protected $fillable = ['title', 'code', 'main_currency'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}

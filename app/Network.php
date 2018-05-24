<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Network
 *
 * @package App
 * @property string $network
 * @property string $network_affiliate
*/
class Network extends Model
{
    use SoftDeletes;

    protected $fillable = ['network', 'network_affiliate'];
    protected $hidden = [];
    public static $searchable = [
        'network',
    ];
    
    
    public function providers() {
        return $this->hasMany(Provider::class, 'network_affiliate_id');
    }
}

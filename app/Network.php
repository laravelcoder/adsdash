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
    
    
    public function provider()
    {
        return $this->belongsToMany(Provider::class, 'network_provider')->withTrashed();
    }
    
}

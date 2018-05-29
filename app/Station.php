<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Station
 *
 * @package App
 * @property string $station_label
 * @property string $channel_number
 * @property string $provider
*/
class Station extends Model
{
    use SoftDeletes;

    protected $fillable = ['station_label', 'channel_number', 'provider_id'];
    protected $hidden = [];
    public static $searchable = [
        'station_label',
        'channel_number',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProviderIdAttribute($input)
    {
        $this->attributes['provider_id'] = $input ? $input : null;
    }
    
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id')->withTrashed();
    }
    
}

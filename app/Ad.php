<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Ad
 *
 * @package App
 * @property string $ad_label
 * @property text $ad_description
 * @property integer $total_impressions
 * @property integer $total_networks
 * @property integer $total_channels
*/
class Ad extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['ad_label', 'ad_description', 'total_impressions', 'total_networks', 'total_channels'];
    protected $hidden = [];
    public static $searchable = [
        'ad_label',
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalImpressionsAttribute($input)
    {
        $this->attributes['total_impressions'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalNetworksAttribute($input)
    {
        $this->attributes['total_networks'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalChannelsAttribute($input)
    {
        $this->attributes['total_channels'] = $input ? $input : null;
    }
    
}

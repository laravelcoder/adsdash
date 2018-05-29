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
 * @property string $created_by
 * @property text $ad_description
 * @property integer $total_impressions
 * @property integer $total_networks
 * @property integer $total_channels
*/
class Ad extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['ad_label', 'ad_description', 'total_impressions', 'total_networks', 'total_channels', 'created_by_id'];
    protected $hidden = [];
    public static $searchable = [
        'ad_label',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

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
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}

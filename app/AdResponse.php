<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdResponse
 *
 * @package App
 * @property string $station
 * @property time $time
 * @property integer $impressions
 * @property integer $non_impressions
 * @property string $cypi_id
*/
class AdResponse extends Model
{
    use SoftDeletes;

    protected $fillable = ['time', 'impressions', 'non_impressions', 'cypi_id', 'station_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setStationIdAttribute($input)
    {
        $this->attributes['station_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['time'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            $this->attributes['time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setImpressionsAttribute($input)
    {
        $this->attributes['impressions'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNonImpressionsAttribute($input)
    {
        $this->attributes['non_impressions'] = $input ? $input : null;
    }
    
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id')->withTrashed();
    }
    
}

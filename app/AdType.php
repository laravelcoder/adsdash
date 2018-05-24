<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdType
 *
 * @package App
 * @property string $codec
 * @property string $extention
 * @property string $ad
*/
class AdType extends Model
{
    protected $fillable = ['codec', 'extention', 'ad_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAdIdAttribute($input)
    {
        $this->attributes['ad_id'] = $input ? $input : null;
    }
    
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }
    
}

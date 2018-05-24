<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Demographic
 *
 * @package App
 * @property string $demographic
 * @property string $value
 * @property string $audience
*/
class Demographic extends Model
{
    use SoftDeletes;

    protected $fillable = ['demographic', 'value', 'audience_id'];
    protected $hidden = [];
    public static $searchable = [
        'demographic',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAudienceIdAttribute($input)
    {
        $this->attributes['audience_id'] = $input ? $input : null;
    }
    
    public function audience()
    {
        return $this->belongsTo(Audience::class, 'audience_id')->withTrashed();
    }
    
}

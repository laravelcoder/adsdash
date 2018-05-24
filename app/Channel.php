<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Channel
 *
 * @package App
 * @property integer $channel
 * @property string $channel_name
*/
class Channel extends Model
{
    use SoftDeletes;

    protected $fillable = ['channel', 'channel_name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setChannelAttribute($input)
    {
        $this->attributes['channel'] = $input ? $input : null;
    }
    
}

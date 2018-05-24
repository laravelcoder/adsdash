<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Ad
 *
 * @package App
 * @property string $link
 * @property string $ad_label
 * @property string $ad_type
 * @property string $created_by
*/
class Ad extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['link', 'ad_label', 'ad_type', 'created_by_id'];
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
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\Traits\FilterByUser;

/**
 * Class Clipdb
 *
 * @package App
 * @property string $clip_label
 * @property string $created_by_team
*/
class Clipdb extends Model
{
    use SoftDeletes, FilterByUser, FilterByUser;

    protected $fillable = ['clip_label', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
        'clip_label',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByTeamIdAttribute($input)
    {
        $this->attributes['created_by_team_id'] = $input ? $input : null;
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
}

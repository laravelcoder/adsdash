<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\Traits\FilterByUser;

/**
 * Class UserBase
 *
 * @package App
 * @property string $name
 * @property string $value
 * @property string $created_by_team
*/
class UserBase extends Model
{
    use SoftDeletes, FilterByUser, FilterByUser;

    protected $fillable = ['name', 'value', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
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

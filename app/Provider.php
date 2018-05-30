<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\Traits\FilterByUser;

/**
 * Class Provider
 *
 * @package App
 * @property string $provider
 * @property string $created_by_team
*/
class Provider extends Model
{
    use SoftDeletes, FilterByUser, FilterByUser;

    protected $fillable = ['provider', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
        'provider',
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
    
    public function stations() {
        return $this->hasMany(Station::class, 'provider_id');
    }
}

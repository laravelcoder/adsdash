<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class ClientProject
 *
 * @package App
 * @property string $title
 * @property string $client
 * @property text $description
 * @property string $date
 * @property string $budget
 * @property string $project_status
*/
class ClientProject extends Model
{
    protected $fillable = ['title', 'description', 'date', 'budget', 'client_id', 'project_status_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectStatusIdAttribute($input)
    {
        $this->attributes['project_status_id'] = $input ? $input : null;
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
    public function project_status()
    {
        return $this->belongsTo(ClientProjectStatus::class, 'project_status_id');
    }
    
}

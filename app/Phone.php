<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\Traits\FilterByUser;

/**
 * Class Phone
 *
 * @package App
 * @property string $phone_number
 * @property string $contact
 * @property string $agent
 * @property string $company
*/
class Phone extends Model
{
    use SoftDeletes, FilterByUser, FilterByUser;

    protected $fillable = ['phone_number', 'contact_id', 'agent_id', 'company_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setContactIdAttribute($input)
    {
        $this->attributes['contact_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAgentIdAttribute($input)
    {
        $this->attributes['agent_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCompanyIdAttribute($input)
    {
        $this->attributes['company_id'] = $input ? $input : null;
    }
    
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
    
    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }
    
}

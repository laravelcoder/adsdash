<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Stylesheet
 *
 * @package App
 * @property string $link
 * @property string $template
*/
class Stylesheet extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['link', 'template_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTemplateIdAttribute($input)
    {
        $this->attributes['template_id'] = $input ? $input : null;
    }
    
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id')->withTrashed();
    }
    
}

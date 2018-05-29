<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TopScript
 *
 * @package App
 * @property string $name
 * @property string $script
 * @property tinyInteger $jquery
 * @property string $template
*/
class TopScript extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'script', 'jquery', 'template_id'];
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

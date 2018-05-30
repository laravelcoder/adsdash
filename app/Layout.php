<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Layout
 *
 * @package App
 * @property string $layout
 * @property string $path
 * @property string $address
 * @property string $template
*/
class Layout extends Model
{
    use SoftDeletes;

    protected $fillable = ['layout', 'path', 'address', 'template_id'];
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

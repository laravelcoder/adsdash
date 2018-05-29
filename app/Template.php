<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Template
 *
 * @package App
 * @property string $template_name
 * @property text $layout
 * @property string $description
*/
class Template extends Model
{
    use SoftDeletes;

    protected $fillable = ['template_name', 'layout', 'description'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function stylesheets() {
        return $this->hasMany(Stylesheet::class, 'template_id');
    }
    public function bottom_scripts() {
        return $this->hasMany(BottomScript::class, 'template_id');
    }
    public function top_scripts() {
        return $this->hasMany(TopScript::class, 'template_id');
    }
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BottomScript
 *
 * @package App
 * @property string $script
 * @property string $name
 * @property tinyInteger $jquery
*/
class BottomScript extends Model
{
    use SoftDeletes;

    protected $fillable = ['script', 'name', 'jquery'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function pages()
    {
        return $this->belongsToMany(ContentPage::class, 'bottom_script_content_page');
    }
    
}

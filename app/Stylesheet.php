<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stylesheet
 *
 * @package App
 * @property integer $order
 * @property string $link
*/
class Stylesheet extends Model
{
    use SoftDeletes;

    protected $fillable = ['order', 'link'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }
    
    public function pages()
    {
        return $this->belongsToMany(ContentPage::class, 'content_page_stylesheet');
    }
    
}

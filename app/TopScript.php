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
*/
class TopScript extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'script', 'jquery'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function pages()
    {
        return $this->belongsToMany(ContentPage::class, 'content_page_top_script');
    }
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentPage
 *
 * @package App
 * @property string $title
 * @property text $page_text
 * @property text $excerpt
 * @property string $featured_image
 * @property string $template
*/
class ContentPage extends Model
{
    protected $fillable = ['title', 'page_text', 'excerpt', 'featured_image', 'template_id'];
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
    
    public function category_id()
    {
        return $this->belongsToMany(ContentCategory::class, 'content_category_content_page');
    }
    
    public function tag_id()
    {
        return $this->belongsToMany(ContentTag::class, 'content_page_content_tag');
    }
    
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id')->withTrashed();
    }
    
}

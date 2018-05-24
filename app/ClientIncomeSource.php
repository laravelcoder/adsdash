<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientIncomeSource
 *
 * @package App
 * @property string $title
 * @property double $fee_percent
*/
class ClientIncomeSource extends Model
{
    protected $fillable = ['title', 'fee_percent'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFeePercentAttribute($input)
    {
        if ($input != '') {
            $this->attributes['fee_percent'] = $input;
        } else {
            $this->attributes['fee_percent'] = null;
        }
    }
    
}

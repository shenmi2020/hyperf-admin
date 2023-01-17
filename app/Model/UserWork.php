<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Relations\Pivot;

/**
 * @property int $id 
 * @property string $name 
 * @property string $create_time 
 */
class UserWork extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_work';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
 


}
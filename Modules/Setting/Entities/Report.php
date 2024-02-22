<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\Basic\Entities\Translation;


class Report extends Model
{
    use HasFactory;

    protected $fillable = ['reportable_type','reportable_id','comment','user_id','solved','solved_by'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    protected $table = 'reports';
    public $searchConfig = [];
    public $searchRelationShip  = [];

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }
    public function reportable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function solvedBy()
    {
        return $this->belongsTo(User::class,'solved_by');
    }
}

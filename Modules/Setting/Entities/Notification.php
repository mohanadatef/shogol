<?php

namespace Modules\Setting\Entities;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Entities\Translation;

class Notification extends Model
{
    protected $fillable = [
        'type', 'pusher_id','receiver_id','read_at','notifiable_type','notifiable_id'
    ];
    protected $table = 'notifications';
    public $timestamps = true;
    public $searchRelationShip = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public static function translationKey(){
        return ['title','description'];
    }
    protected $with = ['receiver','title','description'];
    protected $appends = ['createdAtValue','readAtValue','urlValue'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

    public function pusher()
    {
        return $this->belongsTo(User::class, 'pusher_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * calculate time and date
     */
    public function getCreatedAtValueAttribute()
    {
        $now = Carbon::now();
        $read = $this->created_at ? Carbon::parse($this->created_at) : null;
        if(is_null($read))
        {
            return null;
        }
        return $read ? $read->diffInHours($now) <= 23 ? ($read->diffInHours($now) == 0 ? $read->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $read->diffInHours($now) . " " . getCustomTranslation('Hour')) : $read->diffInDays($now) . " " . getCustomTranslation('Day') : null;
    }

    /**
     * calculate time and date
     */
    public function getReadAtValueAttribute()
    {
        $now = Carbon::now();
        $read = $this->read_at ? Carbon::parse($this->read_at) : null;
        if(is_null($read))
        {
            return null;
        }
        return $read ? $read->diffInHours($now) <= 23 ? ($read->diffInHours($now) == 0 ? $read->diffInMinutes($now) . " " . getCustomTranslation('Minute') : $read->diffInHours($now) . " " . getCustomTranslation('Hour')) : $read->diffInDays($now) . " " . getCustomTranslation('Day') : null;
    }

    public function getUrlValueAttribute()
    {
        $type = $this->type;
        $url='#';
        if(strpos($type,'user')){
           $url = route('user.index',['id'=>$this->notifiable_id,'role'=>$this->notifiable->role]);
        }elseif(strpos($type,'ad')){
            $url = route('ad.index',['id'=>$this->notifiable_id]);
        }
        elseif(strpos($type,'task')){
            $url = route('task.index',['id'=>$this->notifiable_id]);
        }
        // dd($url);
        return $url;
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }

    public function title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'title')
            ->where('language_id' ,languageId());
    }

    public function description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'description')
            ->where('language_id' ,languageId());
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LuckyResult extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'link_id',
        'number',
        'result',
        'win_amount',
    ];

    /**
     * Get the link that owns the result.
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}

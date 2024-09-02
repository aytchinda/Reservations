<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Show extends Model implements Feedable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'poster_url',
        'location_id',
        'bookable',
        'price',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shows';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the main location of the show.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the representations of the show.
     */
    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    /**
     * Get the artist types associated with the show.
     */
    public function artistTypes()
    {
        return $this->belongsToMany(ArtistType::class);
    }

    /**
     * Convert the show instance to a FeedItem.
     */
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(config('app.url') . '/show/' . $this->id)
            ->authorName('') // Vous pouvez remplir le nom de l'auteur si nécessaire
            ->authorEmail(''); // Vous pouvez remplir l'email de l'auteur si nécessaire
    }

    /**
     * Get all the feed items.
     */
    public static function getFeedItems()
    {
        return Show::all();
    }
}

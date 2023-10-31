<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models\Published\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $inventory_id
 * @property int $shop_id
 * @property string $is_published
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon $published_first
 * @property \Carbon\Carbon $last_stock_update
 * @property \Carbon\Carbon $published_media_at
 * @property \Carbon\Carbon $published_description_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'shop_id',
        'is_published',
        'published_at',
        'published_first',
        'last_stock_update',
        'published_media_at',
        'published_description_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inventory_id' => 'integer',
        'shop_id' => 'integer',
        'published_at' => 'timestamp',
        'published_first' => 'datetime',
        'last_stock_update' => 'datetime',
        'published_media_at' => 'datetime',
        'published_description_at' => 'datetime',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}

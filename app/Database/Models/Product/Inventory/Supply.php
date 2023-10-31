<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $inventory_id
 * @property int $supplier_id
 * @property int $shop_id
 * @property int $stock
 * @property string $cost
 * @property string $price
 * @property string $shipping
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Supply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'supplier_id',
        'shop_id',
        'stock',
        'cost',
        'price',
        'shipping',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inventory_id' => 'integer',
        'supplier_id' => 'integer',
        'shop_id' => 'integer',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product\Inventory::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}

<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $id_inventory
 * @property int $shop_id
 * @property int $product_id
 * @property int $condition_id
 * @property int $variation_id
 * @property int $supplier_id
 * @property int $description_id
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
        'id_inventory',
        'shop_id',
        'product_id',
        'condition_id',
        'variation_id',
        'supplier_id',
        'description_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'shop_id' => 'integer',
        'product_id' => 'integer',
        'condition_id' => 'integer',
        'variation_id' => 'integer',
        'supplier_id' => 'integer',
        'description_id' => 'integer',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product::class);
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function description(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product\Description::class);
    }
}

<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models\Product\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $inventory_id
 * @property int $supply_id
 * @property int $live_supplier_product_id
 * @property string $is_active
 * @property string $is_blocked
 * @property string $is_live
 * @property string $is_published
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'supply_id',
        'live_supplier_product_id',
        'is_active',
        'is_blocked',
        'is_live',
        'is_published',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inventory_id' => 'integer',
        'supply_id' => 'integer',
        'live_supplier_product_id' => 'integer',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product\Inventory::class);
    }

    public function supply(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Product\Inventory::class);
    }

    public function liveSupplierProduct(): BelongsTo
    {
        return $this->belongsTo(\App\Database\Models\Supplier\Product::class);
    }
}

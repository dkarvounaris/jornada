<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $id_product
 * @property int $unique_by_brand_mpn_id
 * @property int $brand_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_product',
        'unique_by_brand_mpn_id',
        'brand_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'unique_by_brand_mpn_id' => 'integer',
        'brand_id' => 'integer',
    ];

    public function uniqueByBrandMpn(): BelongsTo
    {
        return $this->belongsTo(UniqueProduct::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $id_unique_by_brand_mpn
 * @property int $brand_id
 * @property string $mpn
 * @property string $ean
 * @property int $mpn_list
 * @property int $ean_list
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class UniqueProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_unique_by_brand_mpn',
        'brand_id',
        'mpn',
        'ean',
        'mpn_list',
        'ean_list',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'brand_id' => 'integer',
        'mpn_list' => 'integer',
        'ean_list' => 'integer',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function mpnList(): BelongsTo
    {
        return $this->belongsTo(ProductMpnList::class);
    }

    public function eanList(): BelongsTo
    {
        return $this->belongsTo(ProductEanList::class);
    }
}

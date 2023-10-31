<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas;


enum Product: string /* PHP8.2 readonly */
{
    public const __table = 'products';

    public const id  = 'id';
    case ID = self::id;

    public const id_product  = 'id_product';
    case ID_PRODUCT = self::id_product;

    public const unique_by_brand_mpn_id  = 'unique_by_brand_mpn_id';
    case UNIQUE_BY_BRAND_MPN_ID = self::unique_by_brand_mpn_id;

    public const brand_id  = 'brand_id';
    case BRAND_ID = self::brand_id;
}

<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas;


enum UniqueProduct: string /* PHP8.2 readonly */
{
    public const __table = 'unique_products';

    public const id  = 'id';
    case ID = self::id;

    public const id_unique_by_brand_mpn  = 'id_unique_by_brand_mpn';
    case ID_UNIQUE_BY_BRAND_MPN = self::id_unique_by_brand_mpn;

    public const brand_id  = 'brand_id';
    case BRAND_ID = self::brand_id;

    public const mpn  = 'mpn';
    case MPN = self::mpn;

    public const ean  = 'ean';
    case EAN = self::ean;

    public const mpn_list  = 'mpn_list';
    case MPN_LIST = self::mpn_list;

    public const ean_list  = 'ean_list';
    case EAN_LIST = self::ean_list;
}

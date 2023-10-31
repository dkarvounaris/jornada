<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Published;


enum Product: string /* PHP8.2 readonly */
{
    public const __table = 'products';

    public const id  = 'id';
    case ID = self::id;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;

    public const shop_id  = 'shop_id';
    case SHOP_ID = self::shop_id;

    public const published_at  = 'published_at';
    case PUBLISHED_AT = self::published_at;
}

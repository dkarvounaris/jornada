<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Published\Product;


enum Inventory: string /* PHP8.2 readonly */
{
    public const __table = 'inventories';

    public const id  = 'id';
    case ID = self::id;

    public const inventory_id  = 'inventory_id';
    case INVENTORY_ID = self::inventory_id;

    public const shop_id  = 'shop_id';
    case SHOP_ID = self::shop_id;

    public const is_published  = 'is_published';
    case IS_PUBLISHED = self::is_published;

    public const published_at  = 'published_at';
    case PUBLISHED_AT = self::published_at;

    public const published_first  = 'published_first';
    case PUBLISHED_FIRST = self::published_first;

    public const last_stock_update  = 'last_stock_update';
    case LAST_STOCK_UPDATE = self::last_stock_update;

    public const published_media_at  = 'published_media_at';
    case PUBLISHED_MEDIA_AT = self::published_media_at;

    public const published_description_at  = 'published_description_at';
    case PUBLISHED_DESCRIPTION_AT = self::published_description_at;
}

<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product\Inventory;


enum Supply: string /* PHP8.2 readonly */
{
    public const __table = 'supplies';

    public const id  = 'id';
    case ID = self::id;

    public const inventory_id  = 'inventory_id';
    case INVENTORY_ID = self::inventory_id;

    public const supplier_id  = 'supplier_id';
    case SUPPLIER_ID = self::supplier_id;

    public const shop_id  = 'shop_id';
    case SHOP_ID = self::shop_id;

    public const stock  = 'stock';
    case STOCK = self::stock;

    public const cost  = 'cost';
    case COST = self::cost;

    public const price  = 'price';
    case PRICE = self::price;

    public const shipping  = 'shipping';
    case SHIPPING = self::shipping;
}

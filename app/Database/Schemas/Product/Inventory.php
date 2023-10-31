<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product;


enum Inventory: string /* PHP8.2 readonly */
{
    public const __table = 'inventories';

    public const id  = 'id';
    case ID = self::id;

    public const id_inventory  = 'id_inventory';
    case ID_INVENTORY = self::id_inventory;

    public const shop_id  = 'shop_id';
    case SHOP_ID = self::shop_id;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;

    public const condition_id  = 'condition_id';
    case CONDITION_ID = self::condition_id;

    public const variation_id  = 'variation_id';
    case VARIATION_ID = self::variation_id;

    public const supplier_id  = 'supplier_id';
    case SUPPLIER_ID = self::supplier_id;

    public const description_id  = 'description_id';
    case DESCRIPTION_ID = self::description_id;
}

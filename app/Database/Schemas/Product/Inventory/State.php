<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product\Inventory;


enum State: string /* PHP8.2 readonly */
{
    public const __table = 'states';

    public const id  = 'id';
    case ID = self::id;

    public const inventory_id  = 'inventory_id';
    case INVENTORY_ID = self::inventory_id;

    public const supply_id  = 'supply_id';
    case SUPPLY_ID = self::supply_id;

    public const live_supplier_product_id  = 'live_supplier_product_id';
    case LIVE_SUPPLIER_PRODUCT_ID = self::live_supplier_product_id;

    public const is_active  = 'is_active';
    case IS_ACTIVE = self::is_active;

    public const is_blocked  = 'is_blocked';
    case IS_BLOCKED = self::is_blocked;

    public const is_live  = 'is_live';
    case IS_LIVE = self::is_live;

    public const is_published  = 'is_published';
    case IS_PUBLISHED = self::is_published;
}

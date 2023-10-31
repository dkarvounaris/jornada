<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Supplier;


enum Product: string /* PHP8.2 readonly */
{
    public const __table = 'products';

    public const id  = 'id';
    case ID = self::id;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;
}

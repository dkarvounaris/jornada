<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product;


enum Variation: string /* PHP8.2 readonly */
{
    public const __table = 'variations';

    public const id  = 'id';
    case ID = self::id;

    public const id_variation  = 'id_variation';
    case ID_VARIATION = self::id_variation;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;
}

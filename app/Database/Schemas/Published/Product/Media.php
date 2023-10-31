<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Published\Product;


enum Media: string /* PHP8.2 readonly */
{
    public const __table = 'media';

    public const id  = 'id';
    case ID = self::id;

    public const media_id  = 'media_id';
    case MEDIA_ID = self::media_id;

    public const shop_id  = 'shop_id';
    case SHOP_ID = self::shop_id;

    public const published_at  = 'published_at';
    case PUBLISHED_AT = self::published_at;
}

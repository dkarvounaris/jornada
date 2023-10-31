<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product;


enum Media: string /* PHP8.2 readonly */
{
    public const __table = 'media';

    public const id  = 'id';
    case ID = self::id;

    public const id_media  = 'id_media';
    case ID_MEDIA = self::id_media;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;

    public const type  = 'type';
    case TYPE = self::type;

    public const attachment_id  = 'attachment_id';
    case ATTACHMENT_ID = self::attachment_id;
}

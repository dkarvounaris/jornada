<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product;


enum Description: string /* PHP8.2 readonly */
{
    public const __table = 'descriptions';

    public const id  = 'id';
    case ID = self::id;

    public const product_id  = 'product_id';
    case PRODUCT_ID = self::product_id;

    public const language_id  = 'language_id';
    case LANGUAGE_ID = self::language_id;

    public const name  = 'name';
    case NAME = self::name;

    public const title  = 'title';
    case TITLE = self::title;

    public const short_description  = 'short_description';
    case SHORT_DESCRIPTION = self::short_description;

    public const description  = 'description';
    case DESCRIPTION = self::description;

    public const source  = 'source';
    case SOURCE = self::source;
}

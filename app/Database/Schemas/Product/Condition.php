<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas\Product;


enum Condition: string /* PHP8.2 readonly */
{
    public const __table = 'conditions';

    public const id  = 'id';
    case ID = self::id;

    public const id_condition  = 'id_condition';
    case ID_CONDITION = self::id_condition;

    public const language_id  = 'language_id';
    case LANGUAGE_ID = self::language_id;

    public const condition  = 'condition';
    case CONDITION = self::condition;

    public const description  = 'description';
    case DESCRIPTION = self::description;
}

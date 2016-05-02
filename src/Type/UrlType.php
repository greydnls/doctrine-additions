<?php

namespace Kayladnls\DoctrineAdditions\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use League\Uri;

class UrlType extends StringType
{
    const URL = "url";

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Uri\Schemes\Http::createFromString($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::URL;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}

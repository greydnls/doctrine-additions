<?php

namespace Kayladnls\DoctrineAdditions\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use League\Url\Url;

class UrlType extends StringType
{
    const URL = "url";

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Url::createFromUrl($value);
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

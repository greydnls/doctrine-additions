<?php

namespace Kayladnls\DoctrineAdditions\Test;

use Doctrine\ORM\Tools\SchemaTool;
use Kayladnls\DoctrineAdditions\Test\Entity\LinkedEntity;
use Kayladnls\DoctrineAdditions\Type\UrlType;
use League\Uri;

class UrlTypeTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        \Doctrine\DBAL\Types\Type::addType('url', UrlType::class);
    }

    public function setUp()
    {
        $config = new \Doctrine\ORM\Configuration();
        $config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache());
        $config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache());
        $config->setProxyDir(__DIR__ . '/Proxies');
        $config->setProxyNamespace('KaylaDnls\DoctrineAdditions\Tests\PHPUnit\Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setMetadataDriverImpl($config->newDefaultAnnotationDriver(__DIR__ . '/../Entity'));

        $this->em = \Doctrine\ORM\EntityManager::create(
            array(
                'driver' => 'pdo_sqlite',
                'memory' => true,
            ),
            $config
        );

        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropDatabase();
        $schemaTool->createSchema(array(
            $this->em->getClassMetadata(LinkedEntity::class),
        ));

        $url = new LinkedEntity();
        $url->id = 1;
        $url->link = Uri\Schemes\Http::createFromString("http://github.com/kayladnls?q=is%3Aopen+is%3Apr+author%3Akayladnls");
        $this->em->persist($url);
        $this->em->flush();
    }

    public function testDateGetter()
    {
        $entity = $this->em->find(LinkedEntity::class, 1);

        $url = Uri\Schemes\Http::createFromString("http://github.com/kayladnls?q=is%3Aopen+is%3Apr+author%3Akayladnls");

        $this->assertInstanceOf(Uri\Schemes\Http::class, $entity->link);
        $this->assertEquals($url, $entity->link);
    }

    public function testDateSetter()
    {
        $url = new LinkedEntity();
        $url->id = 2;
        $url->link = Uri\Schemes\Http::createFromString("http://github.com/kayladnls?q=is%3Aopen+is%3Apr+author%3Akayladnls");
        $this->em->persist($url);
        $this->em->flush();
    }
}

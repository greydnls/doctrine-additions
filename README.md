# Doctrine Additions

    
This library offers a custom `UrlType` for Doctrine 2, based on `league/url`. 

For additional information on custom doctrine types see [here](http://doctrine-orm.readthedocs.org/projects/doctrine-orm/en/latest/cookbook/custom-mapping-types.html). 

### Usage:

In your Bootstrap file: 
```
use Doctrine\DBAL\Types\Type;

Type::addType('url', Kayladnls\DoctrineAdditions\Type\UrlType::class);
```

Register the type with your connection: 
```
$conn = $em->getConnection();
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('varchar', 'url');
```
Use The type in your entity:

```
class MyEntity
{
    /** @Column(type="url") */
    private $link;
}
```

#### Attributions
Inspired by [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)
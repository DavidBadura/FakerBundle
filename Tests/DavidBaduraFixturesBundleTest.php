<?php

namespace DavidBadura\FakerBundle\Tests;

use DavidBadura\FakerBundle\DavidBaduraFakerBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use DavidBadura\FakerBundle\DependencyInjection\DavidBaduraFakerExtension;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author David Badura <d.badura@gmx.de>
 */
class DavidBaduraFakerBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultBuild()
    {
        $container = new ContainerBuilder();
        $bundle = new DavidBaduraFakerBundle();

        $bundle->build($container);

        $extension = new DavidBaduraFakerExtension();
        $extension->load(array(), $container);

        $container->compile();

        $faker = $container->get('davidbadura_faker.faker');
        $this->assertInstanceOf('Faker\Generator', $faker);
    }

    public function testGermanBuild()
    {
        $container = new ContainerBuilder();
        $bundle = new DavidBaduraFakerBundle();

        $bundle->build($container);

        $extension = new DavidBaduraFakerExtension();
        $extension->load(array(
            'david_badura_faker' => array(
                'locale' => 'de_DE'
            )
        ), $container);

        $container->compile();

        $faker = $container->get('davidbadura_faker.faker');
        $this->assertInstanceOf('Faker\Generator', $faker);
    }

    public function testAddProvider()
    {

        $container = new ContainerBuilder();
        $bundle = new DavidBaduraFakerBundle();

        $bundle->build($container);

        $extension = new DavidBaduraFakerExtension();
        $extension->load(array(), $container);

        $provider = $container->register('test.provider.book', 'DavidBadura\FakerBundle\Tests\Provider\Book');
        $provider->addArgument(new Reference('davidbadura_faker.faker'));
        $provider->addTag('davidbadura_faker.provider');

        $container->compile();

        $faker = $container->get('davidbadura_faker.faker');
        $this->assertInstanceOf('Faker\Generator', $faker);

        $book = $container->get('test.provider.book');
        $this->assertInstanceOf('DavidBadura\FakerBundle\Tests\Provider\Book', $book);

        $this->assertEquals(13, strlen($faker->ISBN));
    }
}

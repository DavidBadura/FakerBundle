DavidBaduraFakerBundle
=========================

[![Build Status](https://secure.travis-ci.org/DavidBadura/FakerBundle.png)](http://travis-ci.org/DavidBadura/FakerBundle)

This bundle provide the [fzaninotto/Faker](https://github.com/fzaninotto/Faker), a PHP library that generates fake data for you.
You can use this bundle in combination with [DavidBaduraFixturesBundle](https://github.com/DavidBadura/FixturesBundle).


Usage
-----

``` php
$faker = $container->get('davidbadura_faker.faker');
  // generate data by accessing properties
echo $faker->name;
  // 'Lucy Cechtelar';
echo $faker->address;
  // "426 Jordy Lodge
  // Cartwrightshire, SC 88120-6700"
echo $faker->text;
  // Sint velit eveniet. Rerum atque repellat voluptatem quia rerum. Numquam excepturi
  // beatae sint laudantium consequatur. Magni occaecati itaque sint et sit tempore. Nesciunt
  // amet quidem. Iusto deleniti cum autem ad quia aperiam.
  // A consectetur quos aliquam. In iste aliquid et aut similique suscipit. Consequatur qui
  // quaerat iste minus hic expedita. Consequuntur error magni et laboriosam. Aut aspernatur
  // voluptatem sit aliquam. Dolores voluptatum est.
  // Aut molestias et maxime. Fugit autem facilis quos vero. Eius quibusdam possimus est.
  // Ea quaerat et quisquam. Deleniti sunt quam. Adipisci consequatur id in occaecati.
  // Et sint et. Ut ducimus quod nemo ab voluptatum.
```

For more information, you can read the faker library [documentation](https://github.com/fzaninotto/Faker).


Bundle configuration
--------------------

``` yaml
# app/config/config.yml
david_badura_faker:
  locale: de_DE // default  en_EN
```

Add your own Provider
---------------------

First, you must create your provider

``` php
<?php

namespace YourBundle\Faker\Provider;

class Book extends \Faker\Provider\Base
{
  public function title($nbWords = 5)
  {
    $sentence = $this->generator->sentence($nbWords);
    return substr($sentence, 0, strlen($sentence) - 1);
  }

  public function ISBN()
  {
    return $this->generator->randomNumber(13);
  }
}

```

now you can register your provider as a service and add the `davidbadura_faker.provider` tag.

``` yaml
your_bundle.faker.provider.test:
        class: YourBundle\Faker\Provider\Book
        arguments:
            - @davidbadura_faker.faker
        tags:
            -  { name: davidbadura_faker.provider }
```

finaly, you can use your new provider

``` php
$faker = $container->get('davidbadura_faker.faker');
  // generate data by accessing properties
echo $faker->ISBN;
  // '1463738531452';
```

For more information about providers, you can read the faker library [documentation](https://github.com/fzaninotto/Faker).
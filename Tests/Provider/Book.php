<?php

namespace DavidBadura\FakerBundle\Tests\Provider;

use Faker\Provider\Base;

/**
 * @author David Badura <d.badura@gmx.de>
 */
class Book extends Base
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
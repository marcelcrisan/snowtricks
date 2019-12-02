<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trick;

class ImageTest extends TestCase
{
	public function testEntity() {
		$image = new Image();
		$image->setName('image.jpg')
                ->setTrick(new Trick);

        $this->assertEquals('image.jpg', $image->getName());	
		$this->assertInstanceOf(Trick::class, $image->getTrick());
	}
}
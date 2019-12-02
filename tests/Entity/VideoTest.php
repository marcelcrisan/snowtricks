<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trick;

class VideoTest extends TestCase
{
	public function testEntity() {
		$video = new Video();
		$video->setName('video.mp4')
                ->setTrick(new Trick);

        $this->assertEquals('video.mp4', $video->getName());	
		$this->assertInstanceOf(Trick::class, $video->getTrick());
	}
}
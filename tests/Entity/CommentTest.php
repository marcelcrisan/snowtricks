<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trick;

class CommentTest extends TestCase
{
	public function testEntity() {
		$comment = new Comment();
		$comment->setAuthor('User')
                ->setContent('test content')
				->setCreatedAt(new \Datetime)
                ->setTrick(new Trick);

        $this->assertEquals('User', $comment->getAuthor());
		$this->assertEquals('test content', $comment->getContent());
		$this->assertInstanceOf(\Datetime::class, $comment->getCreatedAt());	
		$this->assertInstanceOf(Trick::class, $comment->getTrick());
	}
}
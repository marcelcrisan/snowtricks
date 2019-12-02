<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    public function testToString()
    {
        $trick = new Trick();
        $title = (123);
        $trick->setTitle($title);
        $this->assertSame('123', $trick->getTitle());
    }

    public function testContentSetterGetter()
    {
        $trick = new Trick();

        $trick->setContent('L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux.');

        $this->assertEquals($trick->getContent(), 'L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux.');
    }

    public function testGroupTrickSetterGetter()
    {
        $trick = new Trick();

        $trick->setGroupTrick(new GroupTrick);

        $this->assertInstanceOf(GroupTrick::class, $trick->getGroupTrick());
    }
}
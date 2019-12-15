<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\HomePageController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HomePageControllerTest extends KernelTestCase
{
    private $trickRepository ;

    public function setUp()
    {
        $this->trickRepository = $this->createMock(TrickRepository::class);
    }

    public function testResponse()
    {
        $controller = new HomePageController();

        static::assertInstanceOf(Response::class, $controller->home($this->trickRepository));
    }
}
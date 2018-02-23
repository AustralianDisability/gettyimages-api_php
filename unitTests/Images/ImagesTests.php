<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class ImagesTest extends TestCase
{
    public function testImagesEndpointWithId(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Images()->WithId(12345)->execute();

        $this->assertContains("images/12345", $curlerMock->options[CURLOPT_URL]);
    }

    public function testImagesEndpointWithIds(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(775051817, 775072327, 775114230);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Images()->WithIds($ids)->execute();

        $this->assertContains("images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("ids=775051817%2C775072327%2C775114230", $curlerMock->options[CURLOPT_URL]);
    }  
    
    public function testSingleEventWithFields(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("id", "image_count");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Images()->WithId(12345)->withFields($fields)->execute();

        $this->assertContains("images/12345", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=id%2Cimage_count", $curlerMock->options[CURLOPT_URL]);
    }
}
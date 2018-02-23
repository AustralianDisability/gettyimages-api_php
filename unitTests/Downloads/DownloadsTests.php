<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class DownloadsTest extends TestCase
{
    public function testDownloadsEndpoint(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithCompanyDownloads(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withCompanyDownloads()->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("company_downloads=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithEndDate(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withEndDate("2015-04-01")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("end_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withPage(3)->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withPageSize(50)->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithProductType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withProductType("easyaccess")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_type=easyaccess", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadsEndpointWithStartDate(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Downloads()->withStartDate("2015-04-01")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("start_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }
}
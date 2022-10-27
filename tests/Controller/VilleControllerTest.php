<?php

namespace App\Test\Controller;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VilleControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VilleRepository $repository;
    private string $path = '/ville/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Ville::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ville index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'ville[code_postale]' => 'Testing',
            'ville[commune]' => 'Testing',
            'ville[region]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ville/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ville();
        $fixture->setCodepostale('My Title');
        $fixture->setCommune('My Title');
        $fixture->setRegion('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ville');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ville();
        $fixture->setCodepostale('My Title');
        $fixture->setCommune('My Title');
        $fixture->setRegion('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ville[code_postale]' => 'Something New',
            'ville[commune]' => 'Something New',
            'ville[region]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ville/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCodepostale());
        self::assertSame('Something New', $fixture[0]->getCommune());
        self::assertSame('Something New', $fixture[0]->getRegion());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Ville();
        $fixture->setCodepostale('My Title');
        $fixture->setCommune('My Title');
        $fixture->setRegion('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/ville/');
    }
}

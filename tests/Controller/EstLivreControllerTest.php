<?php

namespace App\Test\Controller;

use App\Entity\EstLivre;
use App\Repository\EstLivreRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstLivreControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EstLivreRepository $repository;
    private string $path = '/est/livre/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(EstLivre::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EstLivre index');

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
            'est_livre[id_commande]' => 'Testing',
            'est_livre[id_livraison]' => 'Testing',
        ]);

        self::assertResponseRedirects('/est/livre/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EstLivre();
        $fixture->setId_commande('My Title');
        $fixture->setId_livraison('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EstLivre');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EstLivre();
        $fixture->setId_commande('My Title');
        $fixture->setId_livraison('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'est_livre[id_commande]' => 'Something New',
            'est_livre[id_livraison]' => 'Something New',
        ]);

        self::assertResponseRedirects('/est/livre/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_commande());
        self::assertSame('Something New', $fixture[0]->getId_livraison());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new EstLivre();
        $fixture->setId_commande('My Title');
        $fixture->setId_livraison('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/est/livre/');
    }
}

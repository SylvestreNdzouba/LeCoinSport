<?php

namespace App\Test\Controller;

use App\Entity\Acheteur;
use App\Repository\AcheteurRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AcheteurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AcheteurRepository $repository;
    private string $path = '/acheteur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Acheteur::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Acheteur index');

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
            'acheteur[nom]' => 'Testing',
            'acheteur[prenom]' => 'Testing',
            'acheteur[tel]' => 'Testing',
            'acheteur[email]' => 'Testing',
            'acheteur[id_ville]' => 'Testing',
        ]);

        self::assertResponseRedirects('/acheteur/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Acheteur();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setTel('My Title');
        $fixture->setEmail('My Title');
        $fixture->setId_ville('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Acheteur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Acheteur();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setTel('My Title');
        $fixture->setEmail('My Title');
        $fixture->setId_ville('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'acheteur[nom]' => 'Something New',
            'acheteur[prenom]' => 'Something New',
            'acheteur[tel]' => 'Something New',
            'acheteur[email]' => 'Something New',
            'acheteur[id_ville]' => 'Something New',
        ]);

        self::assertResponseRedirects('/acheteur/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getTel());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getId_ville());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Acheteur();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setTel('My Title');
        $fixture->setEmail('My Title');
        $fixture->setId_ville('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/acheteur/');
    }
}

<?php

namespace App\Tests\Controller;

use App\Entity\Ressource;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RessourceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $ressourceRepository;
    private string $path = '/ressource/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->ressourceRepository = $this->manager->getRepository(Ressource::class);

        foreach ($this->ressourceRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ressource index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'ressource[nom]' => 'Testing',
            'ressource[description]' => 'Testing',
            'ressource[entreprise]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ressource');

        self::assertSame(1, $this->ressourceRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Ressource();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setEntreprise('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ressource');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Ressource();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ressource[nom]' => 'Something New',
            'ressource[description]' => 'Something New',
            'ressource[entreprise]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ressource');

        $fixture = $this->ressourceRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getEntreprise());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Ressource();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/ressource');
        self::assertSame(0, $this->ressourceRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

<?php

namespace App\Tests\Controller;

use App\Entity\Finalite;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FinaliteControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $finaliteRepository;
    private string $path = '/finalite/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->finaliteRepository = $this->manager->getRepository(Finalite::class);

        foreach ($this->finaliteRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Finalite index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'finalite[nom]' => 'Testing',
            'finalite[description]' => 'Testing',
            'finalite[entreprise]' => 'Testing',
        ]);

        self::assertResponseRedirects('/finalite');

        self::assertSame(1, $this->finaliteRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Finalite();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setEntreprise('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Finalite');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Finalite();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'finalite[nom]' => 'Something New',
            'finalite[description]' => 'Something New',
            'finalite[entreprise]' => 'Something New',
        ]);

        self::assertResponseRedirects('/finalite');

        $fixture = $this->finaliteRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getEntreprise());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Finalite();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/finalite');
        self::assertSame(0, $this->finaliteRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

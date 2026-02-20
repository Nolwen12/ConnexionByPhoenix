<?php

namespace App\Tests\Controller;

use App\Entity\OffreEmploie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class OffreEmploieControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $offreEmploieRepository;
    private string $path = '/offre/emploie/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->offreEmploieRepository = $this->manager->getRepository(OffreEmploie::class);

        foreach ($this->offreEmploieRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('OffreEmploie index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'offre_emploie[nom]' => 'Testing',
            'offre_emploie[mission]' => 'Testing',
            'offre_emploie[profil_rechercher]' => 'Testing',
            'offre_emploie[lieu]' => 'Testing',
            'offre_emploie[info]' => 'Testing',
            'offre_emploie[type_emploie]' => 'Testing',
            'offre_emploie[entreprise]' => 'Testing',
        ]);

        self::assertResponseRedirects('/offre/emploie');

        self::assertSame(1, $this->offreEmploieRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new OffreEmploie();
        $fixture->setNom('My Title');
        $fixture->setMission('My Title');
        $fixture->setProfilRechercher('My Title');
        $fixture->setLieu('My Title');
        $fixture->setInfo('My Title');
        $fixture->setTypeEmploie('My Title');
        $fixture->setEntreprise('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('OffreEmploie');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new OffreEmploie();
        $fixture->setNom('Value');
        $fixture->setMission('Value');
        $fixture->setProfilRechercher('Value');
        $fixture->setLieu('Value');
        $fixture->setInfo('Value');
        $fixture->setTypeEmploie('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'offre_emploie[nom]' => 'Something New',
            'offre_emploie[mission]' => 'Something New',
            'offre_emploie[profil_rechercher]' => 'Something New',
            'offre_emploie[lieu]' => 'Something New',
            'offre_emploie[info]' => 'Something New',
            'offre_emploie[type_emploie]' => 'Something New',
            'offre_emploie[entreprise]' => 'Something New',
        ]);

        self::assertResponseRedirects('/offre/emploie');

        $fixture = $this->offreEmploieRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getMission());
        self::assertSame('Something New', $fixture[0]->getProfilRechercher());
        self::assertSame('Something New', $fixture[0]->getLieu());
        self::assertSame('Something New', $fixture[0]->getInfo());
        self::assertSame('Something New', $fixture[0]->getTypeEmploie());
        self::assertSame('Something New', $fixture[0]->getEntreprise());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new OffreEmploie();
        $fixture->setNom('Value');
        $fixture->setMission('Value');
        $fixture->setProfilRechercher('Value');
        $fixture->setLieu('Value');
        $fixture->setInfo('Value');
        $fixture->setTypeEmploie('Value');
        $fixture->setEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/offre/emploie');
        self::assertSame(0, $this->offreEmploieRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

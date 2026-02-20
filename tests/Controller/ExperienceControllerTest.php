<?php

namespace App\Tests\Controller;

use App\Entity\Experience;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ExperienceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $experienceRepository;
    private string $path = '/experience/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->experienceRepository = $this->manager->getRepository(Experience::class);

        foreach ($this->experienceRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Experience index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'experience[nom_poste]' => 'Testing',
            'experience[nom_entreprise]' => 'Testing',
            'experience[date_debut]' => 'Testing',
            'experience[date_fin]' => 'Testing',
            'experience[adresse]' => 'Testing',
            'experience[cp]' => 'Testing',
            'experience[ville]' => 'Testing',
            'experience[type_emploie]' => 'Testing',
            'experience[demandeur_emploie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/experience');

        self::assertSame(1, $this->experienceRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Experience();
        $fixture->setNomPoste('My Title');
        $fixture->setNomEntreprise('My Title');
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCp('My Title');
        $fixture->setVille('My Title');
        $fixture->setTypeEmploie('My Title');
        $fixture->setDemandeurEmploie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Experience');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Experience();
        $fixture->setNomPoste('Value');
        $fixture->setNomEntreprise('Value');
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setAdresse('Value');
        $fixture->setCp('Value');
        $fixture->setVille('Value');
        $fixture->setTypeEmploie('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'experience[nom_poste]' => 'Something New',
            'experience[nom_entreprise]' => 'Something New',
            'experience[date_debut]' => 'Something New',
            'experience[date_fin]' => 'Something New',
            'experience[adresse]' => 'Something New',
            'experience[cp]' => 'Something New',
            'experience[ville]' => 'Something New',
            'experience[type_emploie]' => 'Something New',
            'experience[demandeur_emploie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/experience');

        $fixture = $this->experienceRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomPoste());
        self::assertSame('Something New', $fixture[0]->getNomEntreprise());
        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCp());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getTypeEmploie());
        self::assertSame('Something New', $fixture[0]->getDemandeurEmploie());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Experience();
        $fixture->setNomPoste('Value');
        $fixture->setNomEntreprise('Value');
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setAdresse('Value');
        $fixture->setCp('Value');
        $fixture->setVille('Value');
        $fixture->setTypeEmploie('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/experience');
        self::assertSame(0, $this->experienceRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

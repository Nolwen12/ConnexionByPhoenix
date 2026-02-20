<?php

namespace App\Tests\Controller;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FormationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $formationRepository;
    private string $path = '/formation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->formationRepository = $this->manager->getRepository(Formation::class);

        foreach ($this->formationRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'formation[nom_ecole]' => 'Testing',
            'formation[diplome]' => 'Testing',
            'formation[date_debut]' => 'Testing',
            'formation[date_fin]' => 'Testing',
            'formation[adresse]' => 'Testing',
            'formation[cp]' => 'Testing',
            'formation[ville]' => 'Testing',
            'formation[demandeur_emploie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/formation');

        self::assertSame(1, $this->formationRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Formation();
        $fixture->setNomEcole('My Title');
        $fixture->setDiplome('My Title');
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCp('My Title');
        $fixture->setVille('My Title');
        $fixture->setDemandeurEmploie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formation');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Formation();
        $fixture->setNomEcole('Value');
        $fixture->setDiplome('Value');
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setAdresse('Value');
        $fixture->setCp('Value');
        $fixture->setVille('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'formation[nom_ecole]' => 'Something New',
            'formation[diplome]' => 'Something New',
            'formation[date_debut]' => 'Something New',
            'formation[date_fin]' => 'Something New',
            'formation[adresse]' => 'Something New',
            'formation[cp]' => 'Something New',
            'formation[ville]' => 'Something New',
            'formation[demandeur_emploie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/formation');

        $fixture = $this->formationRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomEcole());
        self::assertSame('Something New', $fixture[0]->getDiplome());
        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCp());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getDemandeurEmploie());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Formation();
        $fixture->setNomEcole('Value');
        $fixture->setDiplome('Value');
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setAdresse('Value');
        $fixture->setCp('Value');
        $fixture->setVille('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/formation');
        self::assertSame(0, $this->formationRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

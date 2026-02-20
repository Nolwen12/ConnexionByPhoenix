<?php

namespace App\Tests\Controller;

use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EntrepriseControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $entrepriseRepository;
    private string $path = '/entreprise/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->entrepriseRepository = $this->manager->getRepository(Entreprise::class);

        foreach ($this->entrepriseRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entreprise[nom]' => 'Testing',
            'entreprise[nationalite]' => 'Testing',
            'entreprise[activite]' => 'Testing',
            'entreprise[type]' => 'Testing',
            'entreprise[champs_action]' => 'Testing',
            'entreprise[statut]' => 'Testing',
            'entreprise[taille]' => 'Testing',
            'entreprise[secteur_activite]' => 'Testing',
            'entreprise[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/entreprise');

        self::assertSame(1, $this->entrepriseRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('My Title');
        $fixture->setNationalite('My Title');
        $fixture->setActivite('My Title');
        $fixture->setType('My Title');
        $fixture->setChampsAction('My Title');
        $fixture->setStatut('My Title');
        $fixture->setTaille('My Title');
        $fixture->setSecteurActivite('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('Value');
        $fixture->setNationalite('Value');
        $fixture->setActivite('Value');
        $fixture->setType('Value');
        $fixture->setChampsAction('Value');
        $fixture->setStatut('Value');
        $fixture->setTaille('Value');
        $fixture->setSecteurActivite('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entreprise[nom]' => 'Something New',
            'entreprise[nationalite]' => 'Something New',
            'entreprise[activite]' => 'Something New',
            'entreprise[type]' => 'Something New',
            'entreprise[champs_action]' => 'Something New',
            'entreprise[statut]' => 'Something New',
            'entreprise[taille]' => 'Something New',
            'entreprise[secteur_activite]' => 'Something New',
            'entreprise[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/entreprise');

        $fixture = $this->entrepriseRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getNationalite());
        self::assertSame('Something New', $fixture[0]->getActivite());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getChampsAction());
        self::assertSame('Something New', $fixture[0]->getStatut());
        self::assertSame('Something New', $fixture[0]->getTaille());
        self::assertSame('Something New', $fixture[0]->getSecteurActivite());
        self::assertSame('Something New', $fixture[0]->getUser());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('Value');
        $fixture->setNationalite('Value');
        $fixture->setActivite('Value');
        $fixture->setType('Value');
        $fixture->setChampsAction('Value');
        $fixture->setStatut('Value');
        $fixture->setTaille('Value');
        $fixture->setSecteurActivite('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/entreprise');
        self::assertSame(0, $this->entrepriseRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

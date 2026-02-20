<?php

namespace App\Tests\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UsersControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $userRepository;
    private string $path = '/admin/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->userRepository = $this->manager->getRepository(Users::class);

        foreach ($this->userRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'user[email]' => 'Testing',
            'user[roles]' => 'Testing',
            'user[password]' => 'Testing',
            'user[username]' => 'Testing',
            'user[tarif]' => 'Testing',
            'user[entreprise]' => 'Testing',
            'user[demandeurEmploie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/admin');

        self::assertSame(1, $this->userRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Users();
        $fixture->setEmail('My Title');
        $fixture->setRoles('My Title');
        $fixture->setPassword('My Title');
        $fixture->setUsername('My Title');
        $fixture->setTarif('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setDemandeurEmploie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Users();
        $fixture->setEmail('Value');
        $fixture->setRoles('Value');
        $fixture->setPassword('Value');
        $fixture->setUsername('Value');
        $fixture->setTarif('Value');
        $fixture->setEntreprise('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[email]' => 'Something New',
            'user[roles]' => 'Something New',
            'user[password]' => 'Something New',
            'user[username]' => 'Something New',
            'user[tarif]' => 'Something New',
            'user[entreprise]' => 'Something New',
            'user[demandeurEmploie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin');

        $fixture = $this->userRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getRoles());
        self::assertSame('Something New', $fixture[0]->getPassword());
        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getTarif());
        self::assertSame('Something New', $fixture[0]->getEntreprise());
        self::assertSame('Something New', $fixture[0]->getDemandeurEmploie());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Users();
        $fixture->setEmail('Value');
        $fixture->setRoles('Value');
        $fixture->setPassword('Value');
        $fixture->setUsername('Value');
        $fixture->setTarif('Value');
        $fixture->setEntreprise('Value');
        $fixture->setDemandeurEmploie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/admin');
        self::assertSame(0, $this->userRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}

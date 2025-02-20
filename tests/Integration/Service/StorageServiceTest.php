<?php

namespace App\Tests\Integration\Service;

use App\Dto\FileDto;
use App\Entity\StorageFile;
use App\Service\Storage\StorageService;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes\Schema;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StorageServiceTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private StorageService $storageService;

    public function testSaveBase64(): void
    {
        /** Сохранение файла */
        $fileDto = $this->getDefaultFileDto();
        $fileId = $this->storageService->saveBase64($fileDto->base64, $fileDto->name);
        $storageFile = $this->entityManager->find(StorageFile::class, $fileId);
        $this->assertNotEmpty($storageFile);
        $this->assertSame($fileDto->name, $storageFile->getName());
        if (!file_exists($storageFile->getPath())) {
            $this->fail('Файл не сохранился в хранилище');
        }
    }

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->storageService = $container->get(StorageService::class);

        $this->entityManager->createQueryBuilder()->delete(StorageFile::class, 's')->getQuery()->execute();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    private function getDefaultFileDto(): FileDto
    {
        $reflection = new ReflectionClass(FileDto::class);
        $attributes = $reflection->getAttributes(Schema::class);

        foreach ($attributes as $attribute) {

            $schema = $attribute->newInstance(); // Создаём объект `OA\Schema`

            foreach ($schema->properties as $property) {
                if ($property->property === 'base64') {
                    $base64 = $property->example;
                }
            }
        }

        return new FileDto('test.pdf', $base64);
    }
}
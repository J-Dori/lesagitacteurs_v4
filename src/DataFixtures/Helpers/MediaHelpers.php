<?php

declare(strict_types=1);

namespace App\DataFixtures\Helpers;

use Exception;
use League\Flysystem\UnableToCopyFile;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Adeliom\EasyMediaBundle\Exception\AlreadyExist;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

trait MediaHelpers
{
    public function createMedia($folderPath = 'pages/home', $fileName = 'cta-market-col1.jpeg')
    {
        $projectDir = $this->kernel->getProjectDir();
        $manager = $this->easyMediaManager;

        $folders = explode('/', $folderPath);
        foreach ($folders as $key => $folder) {
            try {
                $manager->createFolder($folder, implode('/', array_splice($folders, 0, $key)));
            } catch (AlreadyExist $exception) {
            } catch (Exception $exception) {
                dump($exception->getMessage());
            }
        }

        try {
            return $manager->createMedia($projectDir . '/var/storage/medias/' . $folderPath . '/' . $fileName, $folderPath, $fileName);
        } catch (AlreadyExist $exception) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            if ($ext === 'jpg') $ext = 'jpeg';
            $folder = $manager->folderByPath($folderPath);
            return $manager->getHelper()->getMediaRepository()->findOneBy([
                'folder' => $folder,
                'slug' => (new AsciiSlugger())->slug($fileName)->toString() . '.' . $ext,
            ]);
        } catch (FileException | UnableToCopyFile $exception) {
            dump($exception->getMessage());
        }
        return null;
    }
}

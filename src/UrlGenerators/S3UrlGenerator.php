<?php
declare(strict_types=1);

namespace Plank\Mediable\UrlGenerators;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Filesystem\FilesystemManager;

class S3UrlGenerator extends BaseUrlGenerator implements TemporaryUrlGeneratorInterface
{
    protected FilesystemManager $filesystem;

    /**
     * Constructor.
     * @param Config $config
     * @param FilesystemManager $filesystem
     */
    public function __construct(Config $config, FilesystemManager $filesystem)
    {
        parent::__construct($config);
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function getAbsolutePath(): string
    {
        return $this->getUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl(): string
    {
        /** @var Cloud $filesystem */
        $filesystem = $this->filesystem->disk($this->media->disk);
        return $filesystem->url($this->media->getDiskPath());
    }

    public function getTemporaryUrl(\DateTimeInterface $expiry): string
    {
        /** @var FilesystemAdapter $filesystem */
        $filesystem = $this->filesystem->disk($this->media->disk);
        return $filesystem->temporaryUrl($this->media->getDiskPath(), $expiry);
    }
}

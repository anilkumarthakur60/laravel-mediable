<?php

namespace Plank\Mediable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property Collection<Media> $media
 * @method static Builder withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static Builder withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static Builder withMediaMatchAll($tags = [], bool $withVariants = false)
 * @method static Builder withMediaAndVariantsMatchAll($tags = [])
 * @method static Builder whereHasMedia($tags = [], bool $matchAll = false)
 * @method static Builder whereHasMediaMatchAll($tags)
 */
interface MediableInterface
{
    public function media(): MorphToMany;

    /**
     * @param Builder $q
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return Builder
     */
    public function scopeWhereHasMedia(
        Builder      $q,
        array|string $tags = [],
        bool         $matchAll = false
    ): Builder;

    public function scopeWhereHasMediaMatchAll(Builder $q, array $tags): void;

    /**
     * @param Builder $q
     * @param string|string[] $tags
     * @param bool $matchAll
     * @param bool $withVariants
     * @return Builder
     */
    public function scopeWithMedia(
        Builder      $q,
        array|string $tags = [],
        bool         $matchAll = false,
        bool         $withVariants = false
    ):Builder;

    /**
     * @param Builder $q
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return Builder
     */
    public function scopeWithMediaAndVariants(
        Builder      $q,
        array|string $tags = [],
        bool         $matchAll = false
    ):Builder;

    /**
     * @param Builder $q
     * @param string|string[] $tags
     * @param bool $withVariants
     * @return Builder
     */
    public function scopeWithMediaMatchAll(
        Builder      $q,
        array|string $tags = [],
        bool         $withVariants = false
    ):Builder;

    /**
     * @param Builder $q
     * @param string|string[] $tags
     * @return Builder
     */
    public function scopeWithMediaAndVariantsMatchAll(Builder $q, array|string $tags = []): Builder;

    public function loadMedia();

    /**
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return self
     */
    public function loadMediaWithVariants(array|string $tags = [], bool $matchAll = false): self;

    /**
     * @param string|string[] $tags
     * @param bool $withVariants
     * @return self
     */
    public function loadMediaMatchAll(array|string $tags = [], bool $withVariants = false): self;

    /**
     * @param string|string[] $tags
     * @return self
     */
    public function loadMediaWithVariantsMatchAll(array|string $tags = []): self;

    /**
     * @param int|string|Collection|int[]|Media $media
     * @param string|string[] $tags
     * @return void
     */
    public function attachMedia(array|Collection|int|string|Media $media, array|string $tags): void;

    /**
     * @param int|string|Collection|int[]|Media $media
     * @param string|string[] $tags
     * @return void
     */
    public function syncMedia(array|Collection|int|string|Media $media, array|string $tags): void;

    /**
     * @param int|string|Collection|int[]|Media $media
     * @param string|string[]|null $tags
     * @return void
     */
    public function detachMedia(array|Collection|int|string|Media $media, array|string|null $tags = null): void;

    /**
     * @param string|string[] $tags
     * @return void
     */
    public function detachMediaTags(array|string $tags): void;

    /**
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return bool
     */
    public function hasMedia(array|string $tags, bool $matchAll = false): bool;

    /**
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return Collection
     */
    public function getMedia(array|string $tags, bool $matchAll = false): Collection;

    public function getMediaMatchAll(array $tags): Collection;

    /**
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return Media|null
     */
    public function firstMedia(array|string $tags, bool $matchAll = false): ?Media;

    /**
     * @param string|string[] $tags
     * @param bool $matchAll
     * @return Media|null
     */
    public function lastMedia(array|string $tags, bool $matchAll = false): ?Media;

    public function getAllMediaByTag(): Collection;

    public function getTagsForMedia(Media $media): array;

    /**
     * @param array|string $relations
     * @return mixed
     */
    public function load($relations);

    /**
     * @param array $models
     * @return MediableCollection
     */
    public function newCollection(array $models = []): MediableCollection;
}

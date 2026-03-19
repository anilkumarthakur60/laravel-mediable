<?php
declare(strict_types=1);

namespace Plank\Mediable;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

/**
 * @property string $tag
 * @property int $order
 */
class MediablePivot extends MorphPivot
{
    public function getConnectionName(): ?string
    {
        return config('mediable.connection_name') ?? parent::getConnectionName();
    }
}

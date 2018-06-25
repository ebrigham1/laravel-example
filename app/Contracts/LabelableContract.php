<?php

namespace App\Contracts;

use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface LabelableContract
{
    /**
     * Get all the labelable's labels
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function labels(): MorphMany;

    /**
     * Create any number of labels for this labelable object
     *
     * @param int $number
     * @param \App\Models\Location|null $location
     * @return void
     */
    public function createLabels(int $number = 1, Location $location = null): void;

    /**
     * Get the name of this labelable
     *
     * @return string
     */
    public function getName(): string;
}

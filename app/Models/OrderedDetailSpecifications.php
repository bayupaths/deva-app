<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderedDetailSpecifications extends Pivot
{

    /**
     * table
     *
     * @var string
     */
    public $table = 'ordered_detail_specifications';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'ordered_spec_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}

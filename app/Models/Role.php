<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Attributes that are mass assignable Ex:
     * $role = Role::create($request->all());
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Fall back to name if display name isn't present
     *
     * @param $value
     * @return string
     */
    public function getDisplayNameAttribute($value)
    {
        return $value ? $value : $this->name;
    }
}

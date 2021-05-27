<?php

namespace WalkerChiu\MorphRegistration\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\DateTrait;

class Registration extends Model
{
    use DateTrait;
    use SoftDeletes;

    protected $fillable = [
        'morph_type', 'morph_id',
        'user_id',
        'signup_note', 'signup_code', 'signup_rule_version', 'signup_policy_version',
        'state', 'state_info',
        'rule_version', 'policy_version'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->table = config('wk-core.table.morph-registration.registrations');

        parent::__construct($attributes);
    }

    /**
     * Get the owning commentable model.
     */
    public function morph()
    {
        return $this->morphTo();
    }

    /**
     * @return bool
     */
    public function isInitial()
    {
        return $this->state == 0;
    }

    /**
     * @return bool
     */
    public function isVerifying()
    {
        return $this->state == 1;
    }

    /**
     * @return bool
     */
    public function isConfirming()
    {
        return $this->state == 2;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->state == 3;
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return $this->state == 4;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->state == 5;
    }

    /**
     * @return bool
     */
    public function canModify()
    {
        return in_array($this->state, config('wk-morph-registration.states_can_modify'));
    }
}

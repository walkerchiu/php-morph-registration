<?php

namespace WalkerChiu\MorphRegistration\Models\Observers;

class RegistrationObserver
{
    /**
     * Handle the entity "retrieved" event.
     *
     * @param  $entity
     * @return void
     */
    public function retrieved($entity)
    {
        //
    }

    /**
     * Handle the entity "creating" event.
     *
     * @param  $entity
     * @return void
     */
    public function creating($entity)
    {
        //
    }

    /**
     * Handle the entity "created" event.
     *
     * @param  $entity
     * @return void
     */
    public function created($entity)
    {
        //
    }

    /**
     * Handle the entity "updating" event.
     *
     * @param  $entity
     * @return void
     */
    public function updating($entity)
    {
        //
    }

    /**
     * Handle the entity "updated" event.
     *
     * @param  $entity
     * @return void
     */
    public function updated($entity)
    {
        //
    }

    /**
     * Handle the entity "saving" event.
     *
     * @param  $entity
     * @return void
     */
    public function saving($entity)
    {
        if ( config('wk-core.class.morph-registration.registration')
                ::where('id', '<>', $entity->id)
                ->where('morph_type', $entity->morph_type)
                ->where('morph_id', $entity->morph_id)
                ->where('user_id', $entity->user_id)
                ->exists() )
            return false;
    }

    /**
     * Handle the entity "saved" event.
     *
     * @param  $entity
     * @return void
     */
    public function saved($entity)
    {
        //
    }

    /**
     * Handle the entity "deleting" event.
     *
     * @param  $entity
     * @return void
     */
    public function deleting($entity)
    {
        //
    }

    /**
     * Handle the entity "deleted" event.
     *
     * Its Lang will be automatically removed by database.
     *
     * @param  $entity
     * @return void
     */
    public function deleted($entity)
    {
        if ($entity->isForceDeleting()) {
        }
    }

    /**
     * Handle the entity "restoring" event.
     *
     * @param  $entity
     * @return void
     */
    public function restoring($entity)
    {
        //
    }

    /**
     * Handle the entity "restored" event.
     *
     * @param  $entity
     * @return void
     */
    public function restored($entity)
    {
        //
    }
}

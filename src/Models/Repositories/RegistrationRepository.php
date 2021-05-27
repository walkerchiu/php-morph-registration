<?php

namespace WalkerChiu\MorphRegistration\Models\Repositories;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Forms\FormTrait;
use WalkerChiu\Core\Models\Repositories\Repository;
use WalkerChiu\Core\Models\Repositories\RepositoryTrait;

class RegistrationRepository extends Repository
{
    use FormTrait;
    use RepositoryTrait;

    protected $entity;
    protected $morphType;

    public function __construct()
    {
        $this->entity = App::make(config('wk-core.class.morph-registration.registration'));
    }

    /**
     * @param Array $data
     * @param Int   $page
     * @param Int   $nums per page
     * @return Array
     */
    public function list(Array $data, $page = null, $nums = null)
    {
        $this->assertForPagination($page, $nums);

        $entity = $this->entity;

        $data = array_map('trim', $data);
        $records = $entity->when($data, function ($query, $data) {
                                return $query->unless(empty($data['id']), function ($query) use ($data) {
                                            return $query->where('id', $data['id']);
                                        })
                                        ->unless(empty($data['morph_type']), function ($query) use ($data) {
                                            return $query->where('morph_type', $data['morph_type']);
                                        })
                                        ->unless(empty($data['morph_id']), function ($query) use ($data) {
                                            return $query->where('morph_id', $data['morph_id']);
                                        })
                                        ->unless(empty($data['user_id']), function ($query) use ($data) {
                                            return $query->where('user_id', $data['user_id']);
                                        })
                                        ->unless(empty($data['signup_note']), function ($query) use ($data) {
                                            return $query->where('signup_note', 'LIKE', "%".$data['signup_note']."%");
                                        })
                                        ->unless(empty($data['signup_code']), function ($query) use ($data) {
                                            return $query->where('signup_code', 'LIKE', "%".$data['signup_code']."%");
                                        })
                                        ->unless(empty($data['signup_rule_version']), function ($query) use ($data) {
                                            return $query->where('signup_rule_version', 'LIKE', "%".$data['signup_rule_version']."%");
                                        })
                                        ->unless(empty($data['signup_policy_version']), function ($query) use ($data) {
                                            return $query->where('signup_policy_version', 'LIKE', "%".$data['signup_policy_version']."%");
                                        })
                                        ->unless(empty($data['state']), function ($query) use ($data) {
                                            return $query->where('state', $data['state']);
                                        })
                                        ->unless(empty($data['state_info']), function ($query) use ($data) {
                                            return $query->where('state_info', 'LIKE', "%".$data['state_info']."%");
                                        })
                                        ->unless(empty($data['rule_version']), function ($query) use ($data) {
                                            return $query->where('rule_version', 'LIKE', "%".$data['rule_version']."%");
                                        })
                                        ->unless(empty($data['policy_version']), function ($query) use ($data) {
                                            return $query->where('policy_version', 'LIKE', "%".$data['policy_version']."%");
                                        });
                              })
                            ->orderBy('updated_at', 'DESC')
                            ->get()
                            ->when(is_integer($page) && is_integer($nums), function ($query) use ($page, $nums) {
                                return $query->forPage($page, $nums);
                            });
        $list = [];
        foreach ($records as $record) {
            $data = $record->toArray();
            array_push($list, $data);
        }

        return $list;
    }

    /**
     * @param Registration $entity
     * @return Array
     */
    public function show($entity)
    {
        if (empty($entity))
            return [
                'id'                    => '',
                'morph_type'            => '',
                'morph_id'              => '',
                'user_id'               => '',
                'signup_note'           => '',
                'signup_code'           => '',
                'signup_rule_version'   => '',
                'signup_policy_version' => '',
                'state'                 => '',
                'state_info'            => '',
                'rule_version'          => '',
                'policy_version'        => ''
            ];

        $this->setEntity($entity);

        return [
              'id'                    => $entity->id,
              'morph_type'            => $entity->morph_type,
              'morph_id'              => $entity->morph_id,
              'user_id'               => $entity->user_id,
              'signup_note'           => $entity->signup_note,
              'signup_code'           => $entity->signup_code,
              'signup_rule_version'   => $entity->signup_rule_version,
              'signup_policy_version' => $entity->signup_policy_version,
              'state'                 => $entity->state,
              'state_info'            => $entity->state_info,
              'rule_version'          => $entity->rule_version,
              'policy_version'        => $entity->policy_version
        ];
    }
}

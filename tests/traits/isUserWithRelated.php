<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\traits;

use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;


trait isUserWithRelated
{
    public function createUser(): User
    {
        $user = new User();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }

    public function createUserWithRelation(): UserWithRelations
    {
        $user = new UserWithRelations();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }

    // DEFINE TRAIT WITH MIGRATIONS TO TEST THAT NEED IT
    // TEST FEATURE OF BOTH TRAIT RELATED MODEL
    // BOOT UNITAIRE TEST

}

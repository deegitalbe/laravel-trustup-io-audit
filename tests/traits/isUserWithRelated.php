<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\traits;

use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\database\migrations\CreateUsersTable;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\database\migrations\CreateUsersWithRelationsTable;


trait isUserWithRelated
{
    public function createUser(): User
    {
        $user = new User();
        return $user->create(["name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }

    public function createUserWithRelation(): UserWithRelations
    {
        $user = new UserWithRelations();
        return $user->create(["name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }

    public function migrateRelation(): void
    {
        app()->make(CreateUsersWithRelationsTable::class)->up();
    }

    public function migrateWithourRelation(): void
    {
        app()->make(CreateUsersTable::class)->up();
    }

    // DEFINE TRAIT WITH MIGRATIONS TO TEST THAT NEED IT
    // TEST FEATURE OF BOTH TRAIT RELATED MODEL
    // BOOT UNITAIRE TEST

}

<?php

namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RoleToRelationTrait
{
    private $ALL_RELATION = [
        "kaprog"      => "kaprog",
        "pb_industri" => "pembimbing",
        "pb_sekolah"  => "pembimbing",
        "walas"       => "walas",
        "tu"          => "tata_usaha",
        "siswa"       => "siswa",
        "hubin"       => "hubin"
    ];
    public function roleToRelation(array|string $roles)
    {
        if (gettype($roles) == "string")
            $roles = array($roles);

        foreach ($this->ALL_RELATION as $role => $relation) {
            if (in_array($role, $roles))
                $pass[] = $relation;
        }
        return $pass ?? throw new NotFoundHttpException;
    }
}
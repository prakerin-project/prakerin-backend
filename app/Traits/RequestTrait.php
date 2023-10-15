<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RequestTrait
{
    public function getRelation(array $request, array $allowed): array
    {
        $relation = [];

        foreach ($request as $req) {
            foreach ($allowed as $allow) {
                if ($req === $allow) {
                    $relation[] = $req;
                }
            }
        }

        return $relation;
    }
}

<?php

namespace App\Scoping;

use App\Scoping\Contracts\Scope;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Filtering
 */
class Scoper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, $scopes = [])
    {
        foreach ($this->limitScopesWithQueryString($scopes) as $key => $scope) {
            if (!$scope instanceof Scope)
                continue;
            $scope->apply($builder, $this->request->get($key));
        }
        return $builder;
    }

    private function limitScopesWithQueryString(array $scopes)
    {

        return Arr::only(
            $scopes,
            array_keys($this->request->all()),
        );
    }
}

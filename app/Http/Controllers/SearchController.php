<?php

namespace App\Http\Controllers;

use App\Models\Documentin;
use App\Models\Documentout;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class SearchController
{
    public function __invoke(Request $request)
    {
        $term = $request->query('term');

        $results = Search::new()
            ->add(Documentin::where('secret',1),'title')
            ->add(Documentout::where('secret',1),'title')
            ->orderByDesc()
            ->paginate(10)
            ->startWithWildcard()
            ->allowEmptySearchQuery()
            ->get($term);
        /* dd($results); */
        return view('search.index', [
            'results' => $results,
            'term'    => $term,
        ]);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Helpers\Constant;
use Closure;

class SetScholarYear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $scholarYear = (auth()->user() && auth()->user()->role != Constant::USER_ROLES['student'])
                    ? $request->currentScholarYear
                    : config('scholaryear.current_scholar_year');

        // Retrive scholaryear from url
        $currentScholarYear = \App\Models\ScholarYear::where('scholar_year', $scholarYear)->first();

        if($currentScholarYear) {
            // Set current scholarYear
            Config::set([
                'scholaryear.current_scholar_year' => $currentScholarYear->scholar_year,
                'scholaryear.current_scholar_year_id' => $currentScholarYear->id
            ]);
        }

        // Set default value of current scholarYear argument
        URL::defaults([
            'currentScholarYear' => $scholarYear
        ]);

        $request->route()->forgetParameter('currentScholarYear');

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Site\Programs;

use App\Deadline;
use App\Http\Controllers\Controller;
use App\Program;
use App\Start;
use App\Test;
use App\UniversityImage;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Compare programs
     *
     * @return view
     */
    public function index(Request $request) {
        $ids = explode(',',trim($request->ids, ','));
        $count_limit = 3;
        $programs = Program::whereIn('id', $ids)->where('status', 1)->with('tests')->limit($count_limit)->get();
        foreach($programs as $program) {
            $cover = UniversityImage::where('university_id',$program->university_id)->where('code','cover')->first();
            $program->cover_img = asset('images/universities/'.$cover->image);
            $program->start_date = Start::where('program_id', $program->id)->value('date');
            $program->deadline_date = Deadline::where('program_id', $program->id)->value('date');
            $program->other_links = array_values(array_diff($ids, [$program->id]));
            $program->remove_link = route('site.compare.index', ['ids' => implode(',', $program->other_links)]);
        }

        if(! isset($request->ids) || $request->ids == '' || count($ids) <= 0 || count($ids) > $count_limit || count($programs) == 0) {
            return redirect()->route('programs');
        }

        $tests = Test::whereHas('programLanguageTests', function ($query) use ($ids) {
            $query->whereIn('program_id', $ids);
        })->get();

        return view('site.pages.compare.programs', compact('programs','count_limit', 'tests'));
    }
}

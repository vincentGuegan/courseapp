<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN episodes ON completions.episode_id = episodes.id
            WHERE episodes.course_id = courses.id
            ) AS participants'
        ))
        ->withCount('episodes')->latest()->get();

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function show(int $id)
    {
        $course = Course::where('id', $id)->with('episodes')->first();
        $watched = auth()->user()->episodes;

        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'episodes' => ['required', 'array'],
            'episodes.*.title' => 'required',
            'episodes.*.description' => 'required',
            'episodes.*.video_url' => 'required',
        ]);

        $course = Course::create($request->all());

        foreach($request->input('episodes') as $episode)
        {
            $episode['course_id'] = $course->id;
            Episode::create($episode);
        }

        return Redirect::route('dashboard')->with('success', 'Félicitation, la formation a bien été mise en ligne.');
    }

    public function toggleProgress(Request $request)
    {
        $id = $request -> input('episodeId');
        $user = auth()->user();

        $user->episodes()->toggle($id);

        return $user->episodes;
    }
}

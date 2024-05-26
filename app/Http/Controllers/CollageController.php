<?php
namespace App\Http\Controllers;


use App\Helpers;
use App\Models\Collage;
use App\Models\Department;
use App\Models\Lecture;
use App\Models\Level;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Setasign\FPDF;
use Illuminate\Support\Facades\Route;
class CollageController extends Controller
{

    public function index()
    {
        $collages = DB::table("collages")
            ->get(["id", "name", "image", "slug"]);

        $trans_collages = [];

        foreach ($collages as $collage) {
            $trans_collages[] = GetTranslation($collage, "ar");
        }

        return Inertia::render("Collages", [
                "is_doctor"=> auth()->guard("doctor")->check(),
                "is_admin"=> auth()->guard("web")->check(),
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
                "collages" => $trans_collages
        ]);
    }


    public function schedule(Collage $collage)
    {
        $table = $collage->tables()->latest()->get();
//        dd($collage);
//        dd($collage->toArray());
        $trans_collage = GetTranslationArray($collage->toArray(), "ar");

        $view_collage  = [
            "id" => $trans_collage->id,
            "name" => $trans_collage->name,
        ];

        $levels = DB::table("levels")
            ->get(["id", "name"]);

        $trans_levels = [];

        foreach ($levels as $level) {
            $trans_levels[] = GetTranslation($level, "ar");
        }

        $lectures = getLecturesGroupedByDay($table[0]->id);
//        dd($lectures, $trans_levels);
        return Inertia::render("Schedule/Page", [
            "is_doctor"=> auth()->guard("doctor")->check(),
            "is_admin"=> auth()->guard("web")->check(),
            "collage" => $view_collage,
            "lectures" => $lectures,
            "levels" => $trans_levels,
            "table_id" => $table->value("id")
        ]);
    }


}

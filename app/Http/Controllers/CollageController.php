<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Collage;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

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
            "collages" => $trans_collages
        ]);
    }
    public function departments(Collage $collage)
    {

        $departments = $collage->departments()->get(["collage_id", "id", "name", "image", "slug"])->toArray();

        // dd($departments);
        $trans_departments = [];

        foreach ($departments as $department) {
            $trans_departments[] = GetTranslationArray($department, "ar");
        }
        return Inertia::render("Departments", [
            "departments" => $trans_departments
        ]);
    }

    public function schadule(Collage $collage, Department $department)
    {

        $table = $department->tables()->first();
        $lectures = getLecturesGroupedByDay($table->id);

        return Inertia::render("Schadule/Page", [
            "lectures" => $lectures
        ]);
    }

    public function downloadPDF(Collage $collage, Department $department)
    {
        $groupedLectures = getLecturesGroupedByDay(1);
        $days = ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس'];
        $levelNames = [
            1 => 'المستوى الأول',
            2 => 'المستوى الثاني',
            3 => 'المستوى الثاني',
            4 => 'المستوى الثاني',
            // إضافة المزيد من المستويات حسب الحاجة
        ];

        $pdf = Pdf::loadView('schadule', compact('groupedLectures', 'days', 'levelNames'), [], "utf-8");


        $pdf1 = Pdf::loadHTML("<h1>عبدالكريم العبقري</h1>", "utf-8");
        return $pdf->download('jadwal-kuliah.pdf');
    }
}

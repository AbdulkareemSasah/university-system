import jsPDF from "jspdf";
import { Card, CardHeader, CardTitle, CardContent } from "@/Components/ui/card";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import React from "react";
import { Button } from "@/Components/ui/button";
import Layout from "@/Layouts/Layout";
import Header from "@/Components/Header";
import { Link } from "@inertiajs/react";
import  {useRoute} from "ziggy-js"
const days = {
    1: "السبت",
    2: "الاحد",
    3: "الاثنين",
    4: "الثلاثاء",
    5: "الاربعاء",
    6: "الخميس",
};

type Props = {
    collage: {
        id: number;
        name: string;
    };
    lectures: {
        [day: number]: {
            [levelId: number]: {
                subject_name: string;
                subject_id: number;
                doctor_name: string;
                doctor_id: number;
                departments: {
                    [slug: string]: string;
                };
                start: string;
                end: string;
                classroom_name: string;
                classroom_id: number;
            }[] | [];
        }[] | [];
    };
    levels: {
        id: number;
        name: string;
    }[];
    table_id: number,
    is_user:boolean,
    is_doctor:boolean
};

export default function Schadule({ collage, lectures, levels , table_id,  is_user,is_doctor}: Props) {
    const route = useRoute()

    return (
        <Layout is_user={is_user} is_doctor={is_doctor}>
            <Card>
                <CardHeader className={"flex justify-between"}>
                    <div className="flex justify-between">
                        <CardTitle className={"text-3xl font-extrabold"}>جدول المحاضرات لكلية {collage.name}</CardTitle>
                        <a  href={`${route("pdf", {id:  table_id})}`} target={"_blank"}><Button>تحميل ملف PDF</Button></a>
                    </div>
                </CardHeader>
                <CardContent>
                    <div className="overflow-x-auto">
                        <Table className="table-fixed">
                            <TableHeader>
                                <TableRow className="bg-gray-200 text-xl font-bold h-16">
                                    <TableHead className={"w-32 text-center bg-gray-300"} align={"center"}>
                                        اليوم
                                    </TableHead>
                                    <TableHead className={"w-64 text-xl font-bold text-center bg-gray-300"} align={"center"}>
                                        الوقت
                                    </TableHead>
                                    {levels.map((level) => (
                                        <TableHead
                                            align={"center"}
                                            className={"w-64 text-xl font-bold text-center bg-gray-300"}
                                            key={level.id}
                                        >
                                            {level.name}
                                        </TableHead>
                                    ))}
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {Object.entries(days).map(([dayNumber, dayName]) => (
                                    <TableRow key={dayNumber} className="bg-gray-100">
                                        <TableCell className={"w-32 text-center font-bold"}>{dayName}</TableCell>
                                        <TableCell colSpan={levels.length + 1}>
                                            {lectures[parseInt(dayNumber)]
                                                ? Object.entries(lectures[parseInt(dayNumber)]).flatMap(([levelId, levelLectures]) =>
                                                /* @ts-ignore */
                                                    levelLectures.map((lecture, index) => (
                                                        <div
                                                            key={`${dayNumber}-${levelId}-${lecture.subject_id}`}
                                                            className={`flex items-center ${index % 2 === 0 ? "bg-gray-100" : "bg-white"}`}
                                                        >
                                                            <div className="w-64 text-center font-bold">{`${lecture.start} - ${lecture.end}`}</div>
                                                            {levels.map((level) => (
                                                                <div key={level.id} className="w-64 space-y-2">
                                                                    {level.id === parseInt(levelId) ? (
                                                                        <Card className={"m-2 p-4 rounded-md "}>
                                                                            <CardContent className={"text-center"}>
                                                                                <p className="text-lg font-bold">
                                                                                    {lecture.subject_name}
                                                                                </p>
                                                                                <p>د/{lecture.doctor_name}</p>
                                                                                <p>
                                                                                    {Object.entries(lecture.departments).map(
                                                                                        ([key, value], index, arr) =>
                                                                                            key
                                                                                                ? `${key}${index === arr.length - 1 ? "" : ", "}`
                                                                                                : `${value}${index === arr.length - 1 ? "" : ", "}`
                                                                                    )}
                                                                                </p>
                                                                                <p>{lecture.classroom_name}</p>
                                                                            </CardContent>
                                                                        </Card>
                                                                    ) : (
                                                                        ""
                                                                    )}
                                                                </div>
                                                            ))}
                                                        </div>
                                                    ))
                                                )
                                                : null}
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </div>
                </CardContent>
            </Card>
        </Layout>
    );
}

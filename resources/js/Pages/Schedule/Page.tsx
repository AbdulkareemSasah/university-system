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
import {Link} from "@inertiajs/react";

const days = {
    1: "السبت",
    2: "الاحد",
    3: "الاثنين",
    4: "الثلاثاء",
    5: "الاربعاء",
    6: "الخميس",
};

type Props = {
    lectures: {
        [key: number]: {
            [key: number]: {
                subject_name: string;
                subject_id: number;
                doctor_name: string;
                doctor_id: number;
                departments : {
                  [slug : string]: string
                },
                start: string;
                end: string;
                classroom_name: string;
                classroom_id: number;
            }[] | [];
        }[] | [];
    };
    levels : {
        id: number;
        name :string;
    }[]
};

export default function Schadule({ lectures, levels }: Props) {

    return (
        <Layout>
           alskjdfa;lskjdf
        </Layout>
    );
}

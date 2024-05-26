import React from "react";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "./ui/card";
import { Link } from "@inertiajs/react";
import { useRoute } from "../../../vendor/tightenco/ziggy/src/js";
import { Badge } from "./ui/badge";

type Props = {
    collage_id: number;
    id: number;
    title: string;
    image: string;
};

export default function DepartmentCard({
    collage_id,
    id,
    title,
    image,
}: Props) {
    const route = useRoute();
    return (
        <Link href={route("schadule", { collage: collage_id, department: id })}>
            <Card className="min-w-72">
                <CardContent className="content-center flex items-center justify-center">
                    <img src={`/storage/${image}`} className="h-64" />
                </CardContent>
                <CardFooter className="flex-col gap-y-4 items-start">
                    <CardTitle className="text-2xl">{title}</CardTitle>
                    <CardDescription className="block">
                        <Badge>4 مستويات</Badge>
                    </CardDescription>
                </CardFooter>
            </Card>
        </Link>
    );
}

import React from "react";
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle,
} from "./ui/card";
import { Link } from "@inertiajs/react";
import { useRoute } from "ziggy-js";
import { useAptabase } from "@aptabase/react";
type Props = {
    id: number;
    title: string;
    img: string;
    slug: string;
};

export default function CollageCard({ id, title, img, slug }: Props) {
    const { trackEvent } = useAptabase();
    const route = useRoute();

    return (
        <Link
            onClick={() => trackEvent("collage", { collage: id })}
            href={route("schedule", { collage: id })}
        >
            <Card className="w-full lg:max-w-md">
                <CardContent className="content-center flex items-center justify-center">
                    <img src={`/storage/${img}`} className="h-64" />
                </CardContent>
                <CardFooter>
                    <CardTitle>{title}</CardTitle>
                </CardFooter>
            </Card>
        </Link>
    );
}

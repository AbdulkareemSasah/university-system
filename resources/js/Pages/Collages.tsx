import CollageCard from "@/Components/CollageCard";
import Layout from "@/Layouts/Layout";
import { PageProps } from "@/types";
import React, { useEffect, useState } from "react";
import { useAptabase } from "@aptabase/react";
import { Button } from "@/Components/ui/button";
import { Link } from "@inertiajs/react";
type Props = {
    collages: {
        id: number;
        name: string;
        image: string;
        slug: string;
    }[];
    is_user: boolean;
    is_doctor: boolean;
};

export default function Collages({
    collages,
    is_doctor,
    is_user,
}: PageProps<Props>) {
    const [country, setCountry] = useState<string | null>(null);
    const [isSA, setisSA] = useState(false);
    const { trackEvent } = useAptabase();
    useEffect(() => {
        fetch("https://ipinfo.io/country")
            .then((res) => res.text())
            .then((data) => {
                //  @ts-ignore
                const trimmedData = data.trim(); // إزالة المسافات البيضاء
                setCountry(trimmedData);
            });
    }, []);

    useEffect(() => {
        if (country === "SA") {
            setisSA(true);
        } else {
            setisSA(false);
        }
    }, [country]);

    return (
        <Layout is_doctor={is_doctor} is_user={is_user}>
            <div className="grid lg:grid-cols-3 md:grid-cols-2 w-full lg:w-fit mx-auto justify-center items-center min-h-screen gap-5 ">
                {isSA ? (
                    <div className="space-y-4">
                        <h1>السلام عليكم ورحمه الله </h1>
                        <h1>
                            استاذ انا اشتغلت على هذا الموقع لوسيط بيني وبينك
                        </h1>
                        <h1>
                            واتفقنا على مبلغ 1500 ريال ويعتبر قليل على اللي
                            سويته وتعبي فيه وللان م اعطاني حقي فيه
                        </h1>
                        <h1>فاذا حاب الموقع يجيك عن طريقي </h1>

                        <h1>ارجو التواصل معي على هذا الرقم بالاسفل</h1>

                        <Link
                            onClick={() =>
                                trackEvent("click", { event_name: "on_number" })
                            }
                            href="https://wa.me/966508071811"
                        >
                            <Button>اضغط هنا للتواصل 966508071811 </Button>
                        </Link>
                        <h1>
                            مع العلم الموقع دا للتجربه وبيفتح للسعوديين بمحتوى
                            مختلف عن المحتوى اللي يظهر عندما يفتح لغيرهم
                        </h1>
                        <h1>والوسيط اللي بيني وبينك اكتشفت انه من اليمن</h1>
                    </div>
                ) : (
                    collages.map(({ id, name, image, slug }) => (
                        <CollageCard
                            key={id}
                            title={name}
                            img={image}
                            slug={slug}
                            id={id}
                        />
                    ))
                )}
            </div>
        </Layout>
    );
}

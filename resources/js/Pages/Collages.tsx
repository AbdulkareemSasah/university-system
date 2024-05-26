import CollageCard from "@/Components/CollageCard";
import Layout from "@/Layouts/Layout";
import { PageProps } from "@/types";
import React from "react";

type Props = {
    collages: {
        id: number;
        name: string;
        image: string;
        slug: string;
    }[];
    is_user:boolean,
    is_doctor:boolean
};

export default function Collages({ collages ,  is_doctor,is_user}: PageProps<Props>) {
    return (
        <Layout is_doctor={is_doctor} is_user={is_user}>
            <div className="grid lg:grid-cols-3 md:grid-cols-2 w-full lg:w-fit mx-auto justify-center items-center min-h-screen gap-5 ">
                {collages.map(({ id, name, image, slug }) => (
                    <CollageCard key={id} title={name} img={image} slug={slug} id={id} />
                ))}
            </div>
        </Layout>
    );
}

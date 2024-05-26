import { PageProps } from "@/types";
import Layout from "@/Layouts/Layout";

export default function Welcome({}: PageProps<{
    laravelVersion: string;
    phpVersion: string;
}>) {
    return (
        <Layout>
            <div className="h-screen">sdf</div>
        </Layout>
    );
}

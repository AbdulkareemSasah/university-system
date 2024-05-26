import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";
import { PropsWithChildren } from "react";

export default function Layout({ children }: PropsWithChildren) {
    return (
        <div className="min-h-screen">
            <Navbar />
            <main className="my-24">{children}</main>
            <Footer />
        </div>
    );
}

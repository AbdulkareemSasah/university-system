import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";
import { PropsWithChildren } from "react";
type Props  = {
    is_user:boolean,
    is_doctor:boolean
} & PropsWithChildren
export default function Layout({ children,is_doctor,is_user }: Props) {
    return (
        <div className="min-h-screen bg-gray-50">
            <Navbar is_doctor={is_doctor}  is_user={is_user} />
            <main className="my-24">{children}</main>
            <Footer />
        </div>
    );
}

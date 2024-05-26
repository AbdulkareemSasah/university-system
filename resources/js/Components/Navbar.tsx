import React, {useEffect} from "react";
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuIndicator,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
    NavigationMenuViewport,
    navigationMenuTriggerStyle,
} from "@/Components/ui/navigation-menu";
import {Link, router, usePage} from "@inertiajs/react";
import { Button } from "./ui/button";
import { GridIcon } from "@radix-ui/react-icons";
import {
    Sheet,
    SheetTrigger,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetDescription,
} from "./ui/sheet";
import ModeToggle from "./ModeToggle";
import Logout from "@/Components/Logout";
type Props = {
    is_user:boolean,
    is_doctor:boolean
};

export default function Navbar({is_user,is_doctor}: Props) {


    return (
        <nav className="w-full z-50 fixed top-0 bg-gray-200 left-0 flex justify-between items-center h-16 px-3 backdrop-blur-lg">
            <div className="md:hidden">
                <Sheet>
                    <SheetTrigger>
                        <GridIcon />
                    </SheetTrigger>
                    <SheetContent>
                        <SheetHeader className="my-4">
                            <SheetTitle>جامعة تبوك</SheetTitle>
                        </SheetHeader>
                        <Link href="/">
                            <Button variant={"ghost"} className="w-full">
                                الرئيسية
                            </Button>
                        </Link>
                        <Link href="/collages">
                            <Button variant={"ghost"} className="w-full">
                                الجداول الدراسية
                            </Button>
                        </Link>
                    </SheetContent>
                </Sheet>
            </div>
            <div className="">
                <div className="text-2xl">جامعة تبوك</div>
            </div>
            <NavigationMenu className="hidden md:block ">
                <NavigationMenuList className={"flex-row-reverse"}>
                    <NavigationMenuItem >
                        <Link href="/">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()+" bg-gray-200"}
                            >
                                الرئيسية
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/collages">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()+" bg-gray-200"}
                            >
                                الجداول الدراسية
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
 <NavigationMenuItem>
                        <Link href="/collages">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()+" bg-gray-200"}
                            >
                                التخصصات
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
 <NavigationMenuItem>
                        <Link href="/collages">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()+" bg-gray-200"}
                            >
                                عن الجامعة
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
 <NavigationMenuItem>
                        <Link href="/collages">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()+" bg-gray-200"}
                            >
                                بوابة الطالب
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>

            <div className="flex gap-4">
                <ModeToggle />
                {is_doctor  ?
                    <>
                        <Logout />
                        <a href={"/lectures"}><Button>محاضراتي</Button></a>
                    </> :
                    is_user ?
                        <>
                            <Logout />
                            <Link href={"/dashboard"}><Button>لوحة التحكم</Button></Link>
                        </> :
                        <Link href={"/login"}><Button>تسجيل الدخول</Button></Link>
                }
            </div>
        </nav>
    );
}

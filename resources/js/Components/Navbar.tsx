import React from "react";
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
import { Link } from "@inertiajs/react";
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
type Props = {};

export default function Navbar({}: Props) {
    return (
        <nav className="w-full z-50 fixed top-0 left-0 flex justify-between items-center h-16 px-3 backdrop-blur-lg">
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
            <NavigationMenu className="hidden md:block">
                <NavigationMenuList>
                    <NavigationMenuItem>
                        <Link href="/">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()}
                            >
                                الرئيسية
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/collages">
                            <NavigationMenuLink
                                className={navigationMenuTriggerStyle()}
                            >
                                الجدول الدراسي
                            </NavigationMenuLink>
                        </Link>
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>
            <div className="flex gap-4">
                <ModeToggle />
                <Button>تسجيل الدخول</Button>
            </div>
        </nav>
    );
}

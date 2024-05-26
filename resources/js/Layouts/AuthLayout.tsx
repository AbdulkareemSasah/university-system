import React, {PropsWithChildren} from "react";

export default function  AuthLayout({children} : PropsWithChildren)  {
    return (
        <main   className={"h-screen w-full flex items-center justify-center"}>{children}</main>
    )
}

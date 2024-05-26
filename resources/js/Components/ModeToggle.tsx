import React, { useState } from "react";
import { Button } from "./ui/button";
import { MoonIcon, SunIcon } from "@radix-ui/react-icons";

type Props = {};

export default function ModeToggle({}: Props) {
    const [mode, setMode] = useState(
        document.documentElement.classList.contains("dark")
    );

    function setThemeMode() {
        setMode(!mode);
        document.documentElement.classList.contains("dark")
            ? document.documentElement.classList.remove("dark")
            : document.documentElement.classList.add("dark");
    }
    return (
        <Button variant={"ghost"} onClick={setThemeMode}>
            {mode ? (
                <MoonIcon className="transition-all rotate-45 duration-200" />
            ) : (
                <SunIcon className="transition-all rotate-45 duration-200" />
            )}
        </Button>
    );
}

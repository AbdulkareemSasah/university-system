import React from "react";

type Props = {
    title: string;
    description?: string;
    children: React.ReactNode;
};

export default function Header({ title, description, children }: Props) {
    return (
        <div className="w-full h-36 p-6 flex justify-between items-center bg-primary-foreground">
            <div>
                <h1 className="text-4xl">{title}</h1>
                <p>{description}</p>
            </div>
            <div>{children}</div>
        </div>
    );
}

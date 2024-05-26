import React from "react";

type Props = {};

export default function Footer({}: Props) {
    return (
        <footer className="bg-primary dark:bg-primary-foreground p-6">
            <div className="text-lg text-primary-foreground dark:text-primary">
                جميع الحقوق محفوظة لجامعة تبوك
            </div>
        </footer>
    );
}

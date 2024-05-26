// Logout.js
import React from 'react';

import {Button} from "@/Components/ui/button";
import {useRoute} from "ziggy-js";
import {Link, router} from "@inertiajs/react";

const Logout = () => {



    return (

        <Link href="/logout" method="post" as="button" type="button" target={"_self"}>تسديل الخروج</Link>

    );
};

export default Logout;

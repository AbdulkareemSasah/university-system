import React from 'react';
import AuthLayout from "@/Layouts/AuthLayout";
import * as z from 'zod'
import {useForm} from "react-hook-form";
import {zodResolver} from "@hookform/resolvers/zod";
import {Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage} from "@/Components/ui/form";
import {Input} from "@/Components/ui/input";
import {Button} from "@/Components/ui/button";
import {Card, CardContent, CardHeader, CardTitle} from "@/Components/ui/card";
import {router} from "@inertiajs/react";

const formSchema =  z.object({
    email  : z.string().email(),
    password : z.string()
})
function Login() {
    const form = useForm<z.infer<typeof formSchema>>({
        resolver: zodResolver(formSchema),
        defaultValues : {
            email : "",
            password :""
        }
    })
    const onSubmit = (values : z.infer<typeof  formSchema>) => {
        router.post('/login',values)

    }
    return (
        <AuthLayout>
            <Card className={"w-80"}>
                <CardHeader>
                    <CardTitle className={"text-center text-xl font-extrabold"}>تسجيل الدخول</CardTitle>
                </CardHeader>
                <CardContent>
                    <Form {...form}>
                        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                            <FormField
                                control={form.control}
                                name="email"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>الايميل</FormLabel>
                                        <FormControl>
                                            <Input placeholder="" {...field} />
                                        </FormControl>

                                        <FormMessage />
                                    </FormItem>
                                )}
                            />
                            <FormField
                                control={form.control}
                                name="password"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>كلمة المرور</FormLabel>
                                        <FormControl>
                                            <Input type={"password"} placeholder="" {...field} />
                                        </FormControl>

                                        <FormMessage />
                                    </FormItem>
                                )}
                            />
                            <Button type="submit" className={"w-full"}>تسجيل الدخول</Button>
                        </form>
                    </Form>
                </CardContent>
            </Card>

        </AuthLayout>
    );
}

export default Login;

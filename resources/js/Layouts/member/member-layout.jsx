import { useState } from 'react';
import { Link } from '@inertiajs/react';
import { Bell, Home, Users, DollarSign, Calendar, FileText, Menu, Package2, User as UserIcon } from 'lucide-react';

import { Button } from "@/Components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/Components/ui/card";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import { Sheet, SheetContent, SheetTrigger } from "@/Components/ui/sheet";
import ApplicationLogo from '@/Components/ApplicationLogo';

export default function MemberLayout({ user, header, children }) {
    const navigationMenu = [
        { name: 'Dashboard', route: 'member.dashboard', icon: Home },
        { name: 'Keuangan', route: 'member.keuangan.index', icon: DollarSign },
        { name: 'Kegiatan', route: 'member.kegiatan.index', icon: Calendar },
        { name: 'Dokumen', route: 'member.dokumen.index', icon: FileText },
        { name: 'Anggota', route: 'member.anggota.index', icon: Users },
    ];

    return (
        <div className="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
            <div className="hidden border-r bg-muted/40 md:block">
                <div className="flex h-full max-h-screen flex-col gap-2">
                    <div className="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                        <Link href={route('home')} className="flex items-center gap-2 font-semibold">
                            <ApplicationLogo className="h-8 w-auto" />
                            <span className="">UKM Digital</span>
                        </Link>
                    </div>
                    <div className="flex-1">
                        <nav className="grid items-start px-2 text-sm font-medium lg:px-4">
                            {navigationMenu.map((item) => (
                                <Link
                                    key={item.name}
                                    href={route(item.route)}
                                    className={`flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary ${route().current(item.route) ? 'bg-muted text-primary' : ''}`}
                                >
                                    <item.icon className="h-4 w-4" />
                                    {item.name}
                                </Link>
                            ))}
                        </nav>
                    </div>
                </div>
            </div>
            <div className="flex flex-col">
                <header className="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
                    <Sheet>
                        <SheetTrigger asChild>
                            <Button
                                variant="outline"
                                size="icon"
                                className="shrink-0 md:hidden"
                            >
                                <Menu className="h-5 w-5" />
                                <span className="sr-only">Toggle navigation menu</span>
                            </Button>
                        </SheetTrigger>
                        <SheetContent side="left" className="flex flex-col">
                            <nav className="grid gap-2 text-lg font-medium">
                                <Link
                                    href={route('home')}
                                    className="flex items-center gap-2 text-lg font-semibold mb-4"
                                >
                                    <ApplicationLogo className="h-8 w-auto" />
                                    <span className="sr-only">UKM Digital</span>
                                </Link>
                                {navigationMenu.map((item) => (
                                    <Link
                                        key={item.name}
                                        href={route(item.route)}
                                        className={`mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground ${route().current(item.route) ? 'bg-muted text-foreground' : ''}`}
                                    >
                                        <item.icon className="h-5 w-5" />
                                        {item.name}
                                    </Link>
                                ))}
                            </nav>
                        </SheetContent>
                    </Sheet>
                    <div className="w-full flex-1">
                       {header && <h1 className="text-lg font-semibold">{header}</h1>}
                    </div>
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button variant="secondary" size="icon" className="rounded-full">
                                <UserIcon className="h-5 w-5" />
                                <span className="sr-only">Toggle user menu</span>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuLabel>{user.name}</DropdownMenuLabel>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem asChild>
                                <Link href={route('profile.edit')}>Profil Saya</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="#">Bantuan</Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                             <DropdownMenuItem asChild>
                                <Link href={route('logout')} method="post" as="button" className="w-full text-left">
                                    Keluar
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </header>
                <main className="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 bg-gray-50">
                    {children}
                </main>
            </div>
        </div>
    );
}
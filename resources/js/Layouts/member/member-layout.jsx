import { Link } from '@inertiajs/react';
import { 
  Home, 
  Users, 
  DollarSign, 
  Calendar, 
  FileText, 
  Menu, 
  User as UserIcon 
} from 'lucide-react';

import { Button } from '@/Components/ui/button';
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuItem
} from '@/Components/ui/dropdown-menu';
import { Sheet, SheetTrigger, SheetContent } from '@/Components/ui/sheet';

import ApplicationLogo from '@/Components/ApplicationLogo';

export default function MemberLayout({ user, header, children }) {
  const navigationMenu = [
    { name: 'Dashboard', route: 'member.dashboard', icon: Home },
    { name: 'Keuangan',  route: 'member.keuangan.index', icon: DollarSign },
    { name: 'Kegiatan',  route: 'member.kegiatan.index', icon: Calendar },
    { name: 'Dokumen',   route: 'member.dokumen.index',  icon: FileText },
    { name: 'Anggota',   route: 'member.anggota.index',   icon: Users },
  ];

  return (
    <div className="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
      {/* Sidebar desktop */}
      <aside className="hidden md:block border-r bg-muted/40">
        <div className="flex h-full flex-col">
          <div className="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
            <Link href={route('home')} className="flex items-center gap-2 font-semibold">
              <ApplicationLogo className="h-8 w-auto" />
              <span>UKM Digital</span>
            </Link>
          </div>
          <nav className="flex-1 px-2 text-sm font-medium lg:px-4">
            {navigationMenu.map(({ name, route: r, icon: Icon }) => (
              <Link
                key={name}
                href={route(r)}
                className={`
                  flex items-center gap-3 rounded-lg px-3 py-2 
                  transition-all hover:text-primary
                  ${route().current(r) ? 'bg-muted text-primary' : 'text-muted-foreground'}
                `}
              >
                <Icon className="h-4 w-4" />
                {name}
              </Link>
            ))}
          </nav>
        </div>
      </aside>

      {/* Main content */}
      <div className="flex flex-col">
        {/* Header mobile + desktop */}
        <header className="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
          {/* Hamburger mobile */}
          <Sheet>
            <SheetTrigger asChild>
              <Button variant="outline" size="icon" className="md:hidden">
                <Menu className="h-5 w-5" />
                <span className="sr-only">Toggle navigation</span>
              </Button>
            </SheetTrigger>
            <SheetContent side="left" className="flex flex-col">
              <nav className="mt-4 space-y-2 text-lg font-medium">
                <Link href={route('home')} className="flex items-center gap-2 font-semibold mb-6">
                  <ApplicationLogo className="h-8 w-auto" />
                  <span>UKM Digital</span>
                </Link>
                {navigationMenu.map(({ name, route: r, icon: Icon }) => (
                  <Link
                    key={name}
                    href={route(r)}
                    className={`
                      flex items-center gap-4 rounded-xl px-3 py-2 
                      transition hover:text-foreground
                      ${route().current(r) ? 'bg-muted text-foreground' : 'text-muted-foreground'}
                    `}
                  >
                    <Icon className="h-5 w-5" />
                    {name}
                  </Link>
                ))}
              </nav>
            </SheetContent>
          </Sheet>

          {/* Page title */}
          <div className="flex-1">
            {header && <h1 className="text-lg font-semibold">{header}</h1>}
          </div>

          {/* User dropdown */}
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button variant="secondary" size="icon" className="rounded-full">
                <UserIcon className="h-5 w-5" />
                <span className="sr-only">User menu</span>
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

        {/* Content area */}
        <main className="flex-1 p-4 bg-gray-50 lg:p-6">
          {children}
        </main>
      </div>
    </div>
  );
}

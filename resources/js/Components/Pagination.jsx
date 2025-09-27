import React from 'react';
import { Link } from '@inertiajs/react';

export const Pagination = ({ links }) => {
    return (
        <nav className="flex items-center justify-center space-x-1">
            {links.map((link, index) => (
                <Link
                    key={index}
                    href={link.url}
                    className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                        link.active ? 'bg-amber-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'
                    } ${!link.url ? 'text-gray-400 cursor-not-allowed' : ''}`}
                    dangerouslySetInnerHTML={{ __html: link.label }}
                />
            ))}
        </nav>
    );
};
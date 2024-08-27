import React from "react";
import { Link } from "@inertiajs/react";

const Footer = () => {
    const currentYear = new Date().getFullYear();

    return (
        <footer className="flex flex-col sm:flex-row justify-between items-center p-4 bg-gray-100 text-gray-600 text-sm">
            <div>© {currentYear} DC Pizza Meter. All rights reserved.</div>
            <nav className="flex gap-4 mt-2 sm:mt-0">
                <Link href="/terms" className="hover:text-gray-900">
                    Terms of Service
                </Link>
                <Link href="/privacy" className="hover:text-gray-900">
                    Privacy
                </Link>
            </nav>
        </footer>
    );
};

export default Footer;

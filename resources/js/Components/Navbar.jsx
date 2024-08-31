import React from "react";
import { Link } from "@inertiajs/react";
import { Pizza, Beer } from "lucide-react";

const Navbar = () => {
    return (
        <nav className="bg-white shadow-md">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between h-16">
                    <div className="flex items-center">
                        <Link
                            href="/"
                            className="flex-shrink-0 flex items-center"
                        >
                            <Pizza className="h-8 w-auto text-red-500" />
                            <Beer className="h-8 w-auto text-amber-500 ml-2" />
                            <span className="ml-2 text-xl font-bold text-gray-800">
                                DC Pizza Meter
                            </span>
                        </Link>
                    </div>
                    <div className="flex items-center">
                        {/* <Link
                            href="/features"
                            className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Features
                        </Link>
                        <Link
                            href="/about"
                            className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            About
                        </Link> */}
                        <Link
                            href="/contact"
                            className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Contact
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
    );
};

export default Navbar;

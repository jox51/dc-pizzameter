import React from "react";
import { Link } from "@inertiajs/react";

const Hero = () => {
    return (
        <div className="bg-gradient-to-b from-white to-pink-100 py-16">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="text-center">
                    <h1 className="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 mb-4">
                        Uncover DC's Hidden Pulse
                    </h1>
                    <p className="text-xl sm:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Track pizza deliveries and bar activity to predict major
                        events in the nation's capital. When the pizzas are
                        flowing and the bars are quiet, something big is brewing
                        in DC.
                    </p>
                    <div className="flex justify-center space-x-4">
                        {/* <Link
                            href="/popular-activity"
                            className="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            Start Monitoring
                        </Link> */}
                        <Link
                            href="#explanation"
                            className="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            Learn More
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Hero;

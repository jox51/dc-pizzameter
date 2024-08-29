import React from "react";
import { AlertTriangle, TrendingUp, Users } from "lucide-react";

const Explanation = () => {
    return (
        <div
            className="bg-gradient-to-b from-pink-100 to-white py-16 mt-4"
            id="explanation"
        >
            <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 className="text-4xl font-extrabold text-center text-gray-900 mb-12">
                    Why DC Pulse Works
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div className="flex flex-col items-center text-center">
                        <AlertTriangle className="w-12 h-12 text-red-500 mb-4" />
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">
                            Event Prediction
                        </h3>
                        <p className="text-gray-600">
                            High pizza deliveries + low bar activity = potential
                            major DC event
                        </p>
                    </div>
                    <div className="flex flex-col items-center text-center">
                        <TrendingUp className="w-12 h-12 text-yellow-500 mb-4" />
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">
                            Real-time Data
                        </h3>
                        <p className="text-gray-600">
                            Stay updated with live pizza and bar activity data
                            from across the city
                        </p>
                    </div>
                    <div className="flex flex-col items-center text-center">
                        <Users className="w-12 h-12 text-blue-500 mb-4" />
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">
                            Community Insights
                        </h3>
                        <p className="text-gray-600">
                            Benefit from collective observations and discussions
                            about DC's pulse
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Explanation;

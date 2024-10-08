import React, { useState, useEffect } from "react";

const BarActivity = ({ barActivity }) => {
    const getEmoji = (value) => {
        if (value > 100) return "🔥";
        if (value > 50) return "😊";
        return "😴";
    };

    return (
        // Bar Activity
        <div className="p-8 max-w-md mx-auto bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl shadow-lg space-y-6">
            <h2 className="text-3xl font-extrabold text-center text-blue-600">
                Bar Activity
            </h2>
            <div className="bg-white p-4 rounded-xl shadow-inner">
                <div className="flex items-center justify-between">
                    <span className="text-4xl font-bold text-blue-500">
                        {barActivity}
                    </span>
                    <span className="text-3xl">{getEmoji(barActivity)}</span>
                </div>
            </div>
        </div>
    );
};

export default BarActivity;

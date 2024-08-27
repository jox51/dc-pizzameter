import React, { useState, useEffect } from "react";

const PizzaDeliveries = ({ pizzaDeliveries }) => {
    const getEmoji = (value) => {
        if (value > 100) return "🔥";
        if (value > 50) return "😊";
        return "😴";
    };

    return (
        <div className="p-8 max-w-md mx-auto bg-gradient-to-br from-red-100 to-orange-100 rounded-2xl shadow-lg space-y-6">
            <h2 className="text-3xl font-extrabold text-center text-red-600">
                Pizza Deliveries
            </h2>
            <div className="bg-white p-4 rounded-xl shadow-inner">
                <div className="flex items-center justify-between">
                    <span className="text-4xl font-bold text-red-500">
                        {pizzaDeliveries}
                    </span>
                    <span className="text-3xl">
                        {getEmoji(pizzaDeliveries)}
                    </span>
                </div>
            </div>
        </div>
    );
};

export default PizzaDeliveries;

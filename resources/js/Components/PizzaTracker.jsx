import React, { useState, useEffect } from "react";

const PizzaTracker = () => {
    const [pizzaDeliveries, setPizzaDeliveries] = useState(0);
    const [barActivity, setBarActivity] = useState(0);
    const [ratio, setRatio] = useState(0);

    useEffect(() => {
        // Fetch data or update states here
        // This is where you'd typically make API calls or update the state based on real-time data
        // For now, we'll use placeholder values
        setPizzaDeliveries(150);
        setBarActivity(75);
    }, []);

    useEffect(() => {
        // Calculate the ratio whenever pizzaDeliveries or barActivity changes
        if (barActivity !== 0) {
            setRatio(pizzaDeliveries / barActivity);
        }
    }, [pizzaDeliveries, barActivity]);

    return (
        <div className="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md space-y-4">
            <h2 className="text-2xl font-bold text-center">DC Pizza Tracker</h2>
            <div className="space-y-2">
                <div className="flex justify-between">
                    <span>Pizza Deliveries:</span>
                    <span className="font-bold">{pizzaDeliveries}</span>
                </div>
                <div className="flex justify-between">
                    <span>Bar Activity Level:</span>
                    <span className="font-bold">{barActivity}</span>
                </div>
                <div className="flex justify-between">
                    <span>Pizza to Bar Ratio:</span>
                    <span className="font-bold">{ratio.toFixed(2)}</span>
                </div>
            </div>
        </div>
    );
};

export default PizzaTracker;

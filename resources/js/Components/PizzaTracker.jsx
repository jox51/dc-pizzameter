import React, { useState, useEffect } from "react";
import BarActivity from "./BarActivity";
import PizzaDeliveries from "./PizzaDeliveries";
import { usePage, router } from "@inertiajs/react";

const PizzaTracker = () => {
    const [pizzaDeliveries, setPizzaDeliveries] = useState(0);
    const [barActivity, setBarActivity] = useState(0);
    const [ratio, setRatio] = useState(0);
    const { error, averages } = usePage().props;
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (loading && !averages) {
            router.visit(route("popular-times"), {
                method: "get",
                preserveState: true,
                preserveScroll: true,
                only: ["averages"],
                replace: false,
            });
        }
        setPizzaDeliveries(averages.pizza_average_popularity);
        setBarActivity(averages.bar_average_popularity);
        setRatio(() => averages.pizza_bar_ratio);
        setLoading(false);
        console.log({ error, averages, ratio });
    }, [loading]);

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <div className="p-8 max-w-4xl mx-auto">
            <h1 className="text-4xl font-extrabold text-center text-gray-800 mb-8">
                DC Pizza Meter
            </h1>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <PizzaDeliveries pizzaDeliveries={pizzaDeliveries} />
                <BarActivity barActivity={barActivity} />
                <div className="bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl shadow-lg p-6">
                    <h2 className="text-3xl font-extrabold text-center text-purple-600 mb-4">
                        Pizza to Bar Ratio
                    </h2>
                    <div className="bg-white p-4 rounded-xl shadow-inner">
                        <div className="flex items-center justify-between">
                            <span className="text-4xl font-bold text-purple-500">
                                {ratio.toFixed(2)}
                            </span>
                            <span className="text-3xl">
                                {ratio > 1 ? "🍕" : "🍺"}
                            </span>
                        </div>
                    </div>
                    <p className="text-center text-gray-600 text-sm mt-4">
                        Last updated: {new Date().toLocaleString()}
                    </p>
                </div>
            </div>
        </div>
    );
};

export default PizzaTracker;

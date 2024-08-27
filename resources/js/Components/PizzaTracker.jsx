import React, { useState, useEffect } from "react";
import BarActivity from "./BarActivity";
import PizzaDeliveries from "./PizzaDeliveries";
import { usePage, router } from "@inertiajs/react";

const PizzaTracker = () => {
    const [pizzaDeliveries, setPizzaDeliveries] = useState(0);
    const [barActivity, setBarActivity] = useState(0);
    const [ratio, setRatio] = useState(0);
    const [lastUpdated, setLastUpdated] = useState("");
    const { error, averages } = usePage().props;
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (loading && !averages) {
            router.visit(route("popular-data"), {
                method: "get",
                preserveState: true,
                preserveScroll: true,
                only: ["averages"],
                replace: false,
            });
        }
        setPizzaDeliveries(averages?.pizza_average_popularity || 0);
        setBarActivity(averages?.bar_average_popularity || 0);
        setRatio(() => averages?.pizza_bar_ratio || 0);
        setLastUpdated(averages?.last_updated || "");
        setLoading(false);
        console.log({ error, averages, ratio });
    }, [loading, averages]);

    if (loading) {
        return <div>Loading...</div>;
    }

    const getEventProbability = (ratio) => {
        if (ratio > 2) return "High";
        if (ratio > 1) return "Medium";
        return "Low";
    };

    const getEventEmoji = (probability) => {
        if (probability === "High") return "🚨";
        if (probability === "Medium") return "🤔";
        return "🤷";
    };

    return (
        <div className="p-8 max-w-4xl mx-auto">
            <h1 className="text-4xl font-extrabold text-center text-gray-800 mb-8">
                DC Activity Meter
            </h1>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <PizzaDeliveries pizzaDeliveries={pizzaDeliveries} />
                <BarActivity barActivity={barActivity} />
                <div className="bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl shadow-lg p-6">
                    <h2 className="text-3xl font-extrabold text-center text-purple-600 mb-4">
                        Event Probability
                    </h2>
                    <div className="bg-white p-4 rounded-xl shadow-inner">
                        <div className="flex flex-col items-center">
                            <div className="flex items-center justify-center w-full">
                                <span className="text-4xl font-bold text-purple-500 pr-6">
                                    {getEventProbability(ratio)}
                                </span>
                                <span className="text-4xl ml-2">
                                    {getEventEmoji(getEventProbability(ratio))}
                                </span>
                            </div>
                            <span className="text-sm text-gray-500 mt-2">
                                Pizza-to-bar ratio: {ratio.toFixed(2)}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div className="text-center text-gray-500 text-sm mt-8">
                Last updated: {lastUpdated}
            </div>
        </div>
    );
};

export default PizzaTracker;

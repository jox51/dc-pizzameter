import React from "react";
import { usePage, router } from "@inertiajs/react";
import PizzaBackground from "./PizzaBackground";

const Hero = () => {
    const { error, averages } = usePage().props;
    const [loading, setLoading] = React.useState(false);

    // const handleTrackOrder = () => {
    //     setLoading(true);
    //     router.get(
    //         "popular-times",
    //         {},
    //         {
    //             preserveState: true,
    //             preserveScroll: true,
    //             onFinish: () => setLoading(false),
    //         }
    //     );
    // };

    return (
        <div className="relative bg-gradient-to-br from-red-500 to-orange-400 min-h-screen flex items-center justify-center overflow-hidden">
            <div className="absolute inset-0 bg-black opacity-40"></div>
            <div className="relative z-10 text-center px-4 sm:px-6 lg:px-8">
                <h1 className="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-6 tracking-tight shadow-text">
                    DC Pizza Tracker
                </h1>
                <p className="max-w-2xl mx-auto text-2xl sm:text-3xl font-semibold text-yellow-300 mb-8 shadow-text">
                    Real-time updates on DC's pizza scene!
                </p>

                <p className="max-w-2xl mx-auto text-xl sm:text-2xl text-white mb-10 font-medium shadow-text">
                    Keep tabs on your favorite Washington DC pizza orders with
                    ease. Track delivery times, popular toppings, and find the
                    best deals across the city.
                </p>
                <div className="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <button
                        className="btn bg-white text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md"
                        // onClick={handleTrackOrder}
                        disabled={loading}
                    >
                        {loading ? "Loading..." : "Track Your Order"}
                    </button>
                    <button className="btn bg-red-600 text-white hover:bg-red-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                        View Popular Pizzas
                    </button>
                </div>
                {error && <p className="text-red-300 mt-4">{error}</p>}
            </div>
            <div className="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-red-900 to-transparent"></div>
            <div className="absolute top-0 left-0 w-full h-full">
                <PizzaBackground />
            </div>
        </div>
    );
};

export default Hero;

import React from "react";

const Hero = () => {
    return (
        <div className="hero bg-base-200 min-h-screen">
            <div className="hero-content text-center">
                <div className="max-w-md">
                    <h1 className="text-5xl font-bold">DC Pizza Tracker</h1>
                    <p className="py-6">
                        Keep tabs on your favorite Washington DC pizza orders
                        with ease. Track delivery times, popular toppings, and
                        find the best deals across the city.
                    </p>
                    <button className="btn btn-primary">
                        Track Your Order
                    </button>
                </div>
            </div>
        </div>
    );
};

export default Hero;

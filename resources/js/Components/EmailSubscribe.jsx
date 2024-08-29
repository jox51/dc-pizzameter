import React, { useState } from "react";
import { useForm, usePage } from "@inertiajs/react";

const EmailSubscribe = () => {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
    });
    const { message, isSubscribed, newSubscriber } = usePage().props;

    console.log({ message, isSubscribed, newSubscriber });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route("subscribe"), {
            preserveState: true,
            preserveScroll: true,
        });
        reset("email");
    };

    return (
        <div className="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
            <h2 className="text-2xl font-bold text-center mb-4 text-indigo-700">
                Subscribe to High Alerts
            </h2>
            <p className="text-gray-600 mb-4 text-center">
                Want to be notified when there's a high probability of DC
                events? Enter your email below!
            </p>
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <input
                        type="email"
                        name="email"
                        className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter your email"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        required
                    />
                    {isSubscribed && (
                        <div className="text-red-500 text-sm mt-1 text-center">
                            {message}
                        </div>
                    )}
                    {newSubscriber && (
                        <div className="text-green-500 text-sm mt-1 text-center">
                            {message}
                        </div>
                    )}
                </div>
                <button
                    type="submit"
                    className="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                    disabled={processing}
                >
                    {processing ? "Subscribing..." : "Subscribe"}
                </button>
            </form>
            <p className="text-xs text-gray-500 mt-2 text-center">
                We'll never share your email with anyone else.
            </p>
        </div>
    );
};

export default EmailSubscribe;

import React from "react";

const Contact = () => {
    return (
        <div className="min-h-screen bg-gradient-to-b from-white to-pink-100 flex flex-col justify-center items-center px-4">
            <div className="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center">
                <h1 className="text-4xl font-bold text-gray-900 mb-4">
                    Contact Us
                </h1>
                <p className="text-xl text-gray-600 mb-6">
                    For any inquiries or feedback, please reach out to us via
                    email:
                </p>
                <a
                    href="mailto:contact@dcpizzameter.com"
                    className="text-2xl font-semibold text-blue-600 hover:text-blue-800 transition duration-300"
                >
                    contact@dcpizzameter.com
                </a>
                <p className="mt-6 text-lg text-gray-500">
                    We appreciate your interest and will get back to you as soon
                    as possible.
                </p>
            </div>
        </div>
    );
};

export default Contact;

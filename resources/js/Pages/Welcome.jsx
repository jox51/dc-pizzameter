import { Link, Head } from "@inertiajs/react";
import Navbar from "@/Components/Navbar";
import Hero from "@/Components/Hero";
import PizzaTracker from "@/Components/PizzaTracker";
import Explanation from "@/Components/Explanation";
import Footer from "@/Components/Footer";
import EmailSubscribe from "@/Components/EmailSubscribe";

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <div className="flex flex-col min-h-screen">
            <Head title="Welcome" />
            <Navbar />
            <Hero />
            <main className="flex-grow">
                <PizzaTracker />
                <EmailSubscribe />
                <Explanation />
            </main>
            <Footer />
        </div>
    );
}

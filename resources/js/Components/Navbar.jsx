import React from "react";
import PizzaLogo from "./Logo";

const Navbar = () => {
    return (
        <>
            <div className="w-full flex justify-between md:hidden ">
                <a className="btn btn-ghost text-lg">
                    <PizzaLogo />
                    DC Pizza Meter
                </a>

                <div className="dropdown dropdown-end">
                    <button className="btn btn-ghost">
                        <i className="fa-solid fa-bars text-lg"></i>
                    </button>

                    <ul
                        tabindex="0"
                        className="dropdown-content menu z-[1] bg-base-200 p-6 rounded-box shadow w-56 gap-2"
                    >
                        <li>
                            <a>About</a>
                        </li>
                        <li>
                            <a>Regions</a>
                        </li>
                        <li>
                            <a>Statistics</a>
                        </li>
                        <li>
                            <a>Contact</a>
                        </li>
                        <a className="btn btn-primary btn-sm">
                            <i className="fa-solid fa-pizza-slice"></i>
                            Track Now
                        </a>
                    </ul>
                </div>
            </div>

            <div className="w-full hidden md:flex justify-between items-center px-4">
                <a className="btn btn-ghost text-xl">
                    <PizzaLogo />
                    DC Pizza Meter
                </a>

                <ul className="menu menu-horizontal px-1">
                    <li>
                        <a>About</a>
                    </li>
                    <li>
                        <a>Regions</a>
                    </li>
                    <li>
                        <a>Statistics</a>
                    </li>
                    <li>
                        <a>Contact</a>
                    </li>
                </ul>

                <a className="btn btn-primary">
                    <i className="fa-solid fa-pizza-slice mr-2"></i>
                    Track Now
                </a>
            </div>
        </>
    );
};

export default Navbar;

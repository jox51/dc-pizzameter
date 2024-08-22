import React from "react";
import wholePizza from "../../images/whole_pizza.png";
import pizzaSlice from "../../images/pizza_slice.png";

const PizzaBackground = ({ className }) => {
    return (
        <div className={`${className} relative w-full h-full overflow-hidden`}>
            <div className="absolute w-full h-full bg-gray-100">
                {Array.from({ length: 10 }).map((_, index) => {
                    const isWholePizza = Math.random() > 0.5;
                    const randomTop = `${Math.random() * 100}%`;
                    const randomLeft = `${Math.random() * 100}%`;
                    const randomRotation = `${Math.random() * 360}deg`;
                    const randomSize = `${Math.random() * 20 + 10}%`;

                    return (
                        <img
                            key={index}
                            src={isWholePizza ? wholePizza : pizzaSlice}
                            alt={isWholePizza ? "Whole Pizza" : "Pizza Slice"}
                            className="absolute w-auto h-auto opacity-30"
                            style={{
                                top: randomTop,
                                left: randomLeft,
                                transform: `rotate(${randomRotation})`,
                                width: randomSize,
                            }}
                        />
                    );
                })}
                {/* Update image paths to use absolute paths from the public directory */}
            </div>
        </div>
    );
};

export default PizzaBackground;

import { driver } from "driver.js";
import "driver.js/dist/driver.css";

// const driverObj = driver();
// driverObj.highlight({
//     element: "#some-element",
//     popover: {
//         title: "Title",
//         description: "Description",
//     },
// });

if (!localStorage.getItem("driverTourShown")) {
    const driverObj = driver({
        showProgress: true,
        animate: true,
        allowClose: true,
        smoothScroll: true,
        allowKeyboardControl: false,
        // overlayColor: 'red',
        steps: [
            {
                element: "#facebook",
                popover: { title: "Title", description: "Description" },
            },
            {
                element: "#instagram",
                popover: { title: "Title", description: "Description" },
            },
            {
                element: "#youtube",
                popover: { title: "Title", description: "Description" },
            },
            {
                element: "#tiktok",
                popover: { title: "Title", description: "Description" },
            },
            {
                element: "#logo-sidebar",
                popover: { title: "Title", description: "Description" },
            },
            {
                element: "#profile_avatar",
                popover: { title: "Title", description: "Description" },
            },
        ],
        onCloseClick: (element, step, options) => {
            localStorage.setItem("driverTourShown", "true");
            driverObj.destroy();
        },
        onDestroyStarted: () => {
            if (!driverObj.hasNextStep() || confirm("Are you sure?")) {
                localStorage.setItem("driverTourShown", "true");
                driverObj.destroy();
            }
        },
    });

    // Start the tour
    driverObj.drive();
}

localStorage.removeItem("driverTourShown");

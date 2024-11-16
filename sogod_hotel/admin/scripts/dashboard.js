// JavaScript for Admin Dashboard
document.addEventListener("DOMContentLoaded", () => {
    const content = document.getElementById("content");

    // Navigation event listeners
    document.getElementById("home").addEventListener("click", () => {
        content.innerHTML = `<h2>Home</h2><p>Welcome to the Admin Dashboard Home!</p>`;
    });

    document.getElementById("manage-users").addEventListener("click", () => {
        content.innerHTML = `<h2>Manage Users</h2><p>Here you can manage all users of the system.</p>`;
    });

    document.getElementById("manage-bookings").addEventListener("click", () => {
        content.innerHTML = `<h2>Manage Bookings</h2><p>Manage all bookings made by users here.</p>`;
    });

    document.getElementById("add-rooms").addEventListener("click", () => {
        content.innerHTML = `<h2>Add Rooms</h2><p>Here you can add new rooms to the system.</p>`;
    });

    document.getElementById("add-amenities").addEventListener("click", () => {
        content.innerHTML = `<h2>Add Amenities</h2><p>Here you can add or update amenities.</p>`;
    });
});

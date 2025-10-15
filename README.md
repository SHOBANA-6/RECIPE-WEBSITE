# RECIPE-WEBSITE
A web-based recipe platform where users can browse, search, and view various recipes with ingredients and cooking steps. Built using HTML, CSS, and JavaScript to provide an interactive, user-friendly experience for food lovers.

# Recipe Hub - A PHP & MySQL Recipe Website

This is a complete recipe website project built with HTML, CSS, JavaScript, PHP, and MySQL. It features user registration/login, a recipe browser with search and categories, a personal wishlist, and a recipe rating/comment system.

## Features

-   **User Authentication**: Secure user registration and login system.
-   **Recipe Browser**: View recipes by category or search for them.
-   **Detailed Recipe View**: Each recipe has its own page with ingredients, steps, and an embedded video.
-   **Wishlist**: Users can save their favorite recipes to a personal wishlist.
-   **Feedback System**: Users can rate recipes (1-5 stars) and leave comments.
-   **Modern UI**: An attractive orange and white theme.

## Prerequisites

-   [XAMPP](https://www.apachefriends.org/index.html) installed on your machine. This provides Apache, MySQL, and PHP.

## Setup Instructions

### Step 1: Place Files in `htdocs`

1.  Navigate to your XAMPP installation directory (e.g., `C:\xampp`).
2.  Open the `htdocs` folder.
3.  Create a new folder named `recipe-website`.
4.  Place all the project files (`.php`, `.css`, `.js`, etc.) inside this `recipe-website` folder.

Your project path should look like this: `C:\xampp\htdocs\recipe-website`.

### Step 2: Start XAMPP and MySQL

1.  Open the XAMPP Control Panel.
2.  Start the **Apache** and **MySQL** modules.



### Step 3: Create and Import the Database

1.  Open your web browser and go to `http://localhost/phpmyadmin/`.
2.  Click on the **"New"** button in the left sidebar to create a new database.
3.  Enter `recipe_db` as the database name and click **"Create"**.
4.  Select the newly created `recipe_db` database from the sidebar.
5.  Click on the **"Import"** tab at the top.
6.  Click **"Choose File"** and select the `schema.sql` file provided with this project.
7.  Scroll down and click the **"Go"** button to start the import process.

This will create all the necessary tables (`users`, `recipes`, `feedback`, `wishlist`) and populate them with sample data.

### Step 4: Run the Website

1.  You are all set! Open your web browser and navigate to:
    `http://localhost/recipe-website/`

2.  You will be redirected to the login/registration page.
    -   You can register a new account.
    -   Or, you can use the pre-loaded sample user:
        -   **Email**: `test@example.com`
        -   **Password**: `password123`

Enjoy your recipe website!

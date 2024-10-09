# Personalized Movie Database

## Overview

This project is a Personalized Movie Database built using PHP and MySQL. It provides users with a platform to manage their movie collections through a simple and intuitive CRUD (Create, Read, Update, Delete) interface. Users can add movies, edit their details, delete them, and view their entire movie list.

## Features

- **User Authentication**: Users can register, log in, and manage their accounts. Logged-in users will see their username in the navigation bar.
- **CRUD Functionality**: Users can:
  - **Add Movies**: Input movie details such as name, genre, year, rating, and timestamp.
  - **View Movies**: Display a list of movies added by the user.
  - **Edit Movies**: Update movie information.
  - **Delete Movies**: Remove movies from the database.
- **Admin Dashboard**: Admins have access to a special dashboard to manage users and their movies.
- **Total Movie Count**: The dashboard displays the total number of movies added by each user, categorized by genre.
- **Super Admin Role**: A main admin can view all users' movies and manage them.

## Project Structure

### Core Files

- **movie-view.php**: Displays all movies added by the user.
- **movie-add.php**: Allows users to add a new movie.
- **movie-edit.php**: Enables users to edit existing movie details.
- **movie-delete.php**: Handles the deletion of a movie record.

### Layout Files

- **header.php**: Contains the navigation bar and sidebar icons. Displays username after user login.
- **footer.php**: Contains footer details and links to social media accounts.
- **menu.php**: The main menu for the dashboard, with links to movie management options.
- **dashboard.php**: Admin page where the admin can access movie management functions.

### User Authentication

- **unauth-user/Temp-glance.php**: The homepage for unauthorized users. Redirects to this page if a user tries to access the dashboard without logging in.

## Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL database
- A local server environment (like XAMPP or MAMP)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/personalized-movie-database.git




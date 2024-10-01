# Poll Maker Website

## Project Overview
The Poll Maker Website is a web application designed to allow users to create, participate in, and manage polls. Built as part of the ITCS333 course, the main goal is to use web development tools and techniques to create a functional, simple, and responsive website from scratch. The site allows both guests and registered users to browse polls, vote on them, and view results, with registered users having additional privileges such as creating new polls and managing their profiles.

## Features

### 1. Website Design
- **Responsive Design**: The website uses  HTML, CSS, and Media Queries to create a simple yet attractive interface. No external frameworks or templates like Bootstrap were used, ensuring the design is built from the ground up.
- **Unified Look**: All pages maintain a consistent look and feel.
- **No Pre-built Code**: The project adheres to the course requirement of not using any ready-made templates or frameworks to promote learning of web design basics.

### 2. Registration and Login
- **User Registration**:
  - Users can register with their name, email, and a strong password.
  - Server-side validation is implemented using regular expressions (client-side is optional).
  - AJAX is used to check if the email is already in use.
  - Validation errors are displayed on the same page without resetting the form inputs.
- **User Login**:
  - Users can log in with their email and password.

### 3. Poll Management & Participation
- **Poll Browsing**:
  - Both registered users and public guests can browse open and closed polls.
  - Guests can view the results of closed polls but cannot vote.
- **Voting**:
  - Registered users can vote on open polls.
  - Each user is allowed only one vote per poll.
  - Voting results can be viewed after the poll ends.
- **Poll Creation**:
  - Registered users can create new polls by providing a title/question and at least two options.
  - Poll creators can choose to end the poll manually or schedule it to end on a specified date.
  - Once a poll is ended, it becomes view-only for all users.
  
### 4. User Profile Management
- Registered users can view and manage their participation in polls (both created and voted on).

## Technical Details

### Frontend
- **HTML/CSS/Media Query**: Used to create a responsive design that adjusts to different screen sizes.
- **JavaScript (AJAX)**: Implemented for asynchronous email validation during registration to check if the email is already taken.

### Backend
- **PHP (PDO)**: Server-side scripting for user authentication, poll creation, and voting. PDO is used for secure interaction with the MySQL database.
- **MySQL**: A relational database used to store user data, poll information, and votes.

### Security
- **Validation**: All form inputs, including registration and poll creation, are validated on the server using regular expressions. Errors are displayed inline, without clearing the form inputs.
- **Password Hashing**: User passwords are stored securely in the database using hashing.

## Database Structure
The project uses a MySQL database with the following key tables:
1. **Users**: Stores user information including name, email, and hashed password.
2. **Polls**: Stores poll information such as the title/question, options, and poll creator.
3. **Responses**: Stores the votes cast by users, ensuring that only one vote per user per poll is allowed.
4. **Choices**: Stores the choices of the users polls.
5. **settings**: Stores the the information of the website, like if in maintenence mode , website name.

## Installation & Setup

### Requirements
- Apache server
- PHP 7.4+ with PDO extension
- MySQL database

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/altenen-dev/poll-maker

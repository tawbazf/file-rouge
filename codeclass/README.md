# CodeClass

CodeClass is a web-based learning and code collaboration platform built with Laravel. It enables teachers to manage projects, assign rights, review code, and collaborate with students seamlessly.

## Features

- **User Roles:**  
  - Teachers can create projects, assign rights, and manage code reviews.
  - Students can view projects and collaborate on code.
  
- **Project Management:**  
  - Create, edit, view, and delete projects.
  - Track project status and progress.
  
- **Rights Management:**  
  - Teachers can assign or update user rights and permissions.
  
- **Collaboration & Code Reviews:**  
  - Real-time code collaboration features.
  - Code review functionalities for feedback and improvements.

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL or any supported database

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/tawbazf/file-rouge.git
   cd codeclass
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Environment Setup:**

   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update your database configuration in the `.env` file.

4. **Generate an application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```
   
   You can now access the application at `http://127.0.0.1:8000`.

## Project Structure

- **Controllers:**  
  - `DashboardProfController.php`: Handles teacher dashboard functionalities.
  - `ProjetController.php`: Manages CRUD operations for projects.
  - `DroitController.php`: Manages rights and permissions, ensuring that only teachers can update user rights.
  - Other controllers handle code collaboration and review functionalities.

- **Views:**  
  - Located in `resources/views`. Key views include:
    - `dashboardProf.blade.php` for the teacher dashboard.
    - `projects/` for managing projects.
    - `badge.blade.php` for managing badges.
    - More views for code collaboration, code reviews, and statistics.

- **Models:**  
  - `User.php` (with role and permissions handling)
  - `Project.php` (CRUD for projects)
  - `Badge.php` (for badge management)

## User Roles & Permissions

- **Teacher:**  
  - Access to full functionalities including project creation, rights assignment, and code review.
  
- **Student:**  
  - Limited access focusing primarily on viewing projects and collaborating in real time.

The rights management logic is implemented in the `DroitController.php`. Teachers can update other users’ roles and permissions either via a many-to-many relationship or by storing permissions in JSON.

## Contributing

Contributions are welcome! Please fork the repository and submit your pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgments

- [Laravel](https://laravel.com) - The framework used.
- [Laracasts](https://laracasts.com) for excellent Laravel tutorials.
- All contributors who make this project better.
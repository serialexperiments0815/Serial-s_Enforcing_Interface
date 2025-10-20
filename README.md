# Serial Enforcing Interface Database

A simple **web-based criminal records management system** built with **PHP**, **MySQL**, and **HTML/CSS**.  
The project allows creating, viewing, updating, and deleting **person profiles** and their associated **criminal records**.

---

## Features

- **Profile Management**
  - Create a new profile with:
    - Picture upload
    - First, middle, and last names
    - Date of birth
    - State of residence
  - View existing profiles
  - Delete profiles

- **Criminal Record Management**
  - Add multiple criminal offenses per profile
  - Each record includes:
    - Offense date
    - Type of offense
    - Disposition outcome
    - Detailed location (prefix, street, unit, city, state, ZIP, county)
    - Sentence/penalty (optional)
  - Delete individual offenses

- **Landing Page**
  - Navigation to:
    - Profile catalog
    - Profile creation form
    - External “Exit” link

---

## Tech Stack

- **Frontend:** HTML5, CSS3  
- **Backend:** PHP 7+  
- **Database:** MySQL (tested with MariaDB)  
- **File Handling:** JSON intermediary for staging profile data before database commit  

---

## Project Structure

```

main_site.html           # Landing page
catalog.php              # Profile catalog (view, delete, add offenses)
profile_create.php       # Profile creation + criminal record entry form
intermediary.json        # Temporary JSON storage for profile data
graphics.css             # Styling
database_connection.txt  # DB connection details (host, user, password, db)
Database_creator.sql     # Schema & initial inserts
```

---

## Usage

1. **Setup the database**
   ```sql
   SOURCE database_creator.sql;
   ```

2. **Configure DB connection**  
   Edit `database_connection.txt`:
   ```php
   <?php
   $host = "localhost";
   $user = "root";
   $password = "your_password";
   $db = "serial_enforcing_interface_database";
   ?>
   ```

3. **Run locally**  
   Place files in your Apache/Nginx PHP web root (`htdocs/` for XAMPP).  
   Start MySQL + Apache.  
   Visit:
   ```
   http://localhost/main_site.html
   ```

---

## Notes
- Existing pictures are AI-generated using thispersondoesnotexist.com.
- This project is **educational** and not intended for production use.  
- No authentication layer is implemented (all operations are public).  
- SQL queries are as of yet vulnerable to SQL injection (should be updated with prepared statements).  
- File uploads are stored in `Images/` directory.

---

## License

This project is provided **as-is for learning purposes**.  

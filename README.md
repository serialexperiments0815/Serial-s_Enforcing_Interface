# 📑 Serial Enforcing Interface Database

A simple **web-based criminal records management system** built with **PHP**, **MySQL**, and **HTML/CSS**.  
The project allows creating, viewing, updating, and deleting **person profiles** and their associated **criminal records**.

---

## 🚀 Features

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

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3  
- **Backend:** PHP 7+  
- **Database:** MySQL (tested with MariaDB)  
- **File Handling:** JSON intermediary for staging profile data before database commit  

---

## 📂 Project Structure

```
.
├── main_site.html           # Landing page
├── catalog.php              # Profile catalog (view, delete, add offenses)
├── profile_create.php       # Profile creation + criminal record entry form
├── intermediary.json        # Temporary JSON storage for profile data
├── graphics.css             # Styling
├── database_connection.txt  # DB connection details (host, user, password, db)
└── Database_creator.sql            # Schema & initial inserts
```

---

## 📋 Database Schema

### `person_summary`
| Column              | Type         | Notes |
|----------------------|--------------|-------|
| person_number       | INT (PK, AI) | Unique ID |
| picture             | VARCHAR(50)  | Path to image |
| first_name          | VARCHAR(50)  | Required |
| last_name           | VARCHAR(50)  | Required |
| middle_name         | VARCHAR(50)  | Optional |
| date_of_birth       | DATE         | Required |
| state_of_residence  | VARCHAR(50)  | Optional |

### `record_details`
| Column                        | Type        | Notes |
|--------------------------------|-------------|-------|
| record_number                  | INT (PK, AI)| Unique ID |
| person_number_record_details   | INT         | FK → person_summary |
| offense_date                   | DATE        | Required |
| offense                        | VARCHAR(200)| Required |
| disposition_outcome            | VARCHAR(200)| Required |
| offense_location_*             | Various     | Address details |
| sentence_penalty               | VARCHAR(100)| Optional |

---

## ▶️ Usage

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

## 📸 Screenshots

- **Landing Page** → Navigate between catalog, creation, or exit.  
- **Profile Catalog** → View all existing profiles with images and names.  
- **Profile Summary** → Full details + offenses with expandable `<details>`.  
- **Profile Creation** → Upload picture, input data, add offenses, commit to DB.  

---

## ⚠️ Notes
- Profile pictures are AI-generated using thispersondoesnotexist.com.
- This project is **educational** and not intended for production use.  
- No authentication layer is implemented (all operations are public).  
- SQL queries are **not parameterized** → vulnerable to SQL injection (should be updated with prepared statements).  
- File uploads are stored in `Images/` directory → ensure it exists and has proper permissions.  

---

## 📌 To-Do

- [ ] Add authentication (login system)  
- [ ] Add editing functionality for profiles/offenses  
- [ ] Improve input validation & sanitization  
- [ ] Replace inline styles with full CSS  

---

## 📜 License

This project is provided **as-is for learning purposes**.  

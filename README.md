# 📘 Prompt-Powered Kickstart: AI Study Notes Generator with Pure PHP & MySQL

## 🎯 Objective

This project demonstrates how to build a beginner-friendly **AI Study Notes Generator** using PHP and MySQL, integrating Generative AI via OpenAI’s Chat Completion API.

The tool allows students to:

* Enter a topic
* Generate structured study notes (Summary, Exam Questions, Key Points)
* Save notes to a MySQL database
* Export notes as PDF
* Delete notes
* Switch between **Demo Mode** and **Live Mode** (real API integration)

**Learning Goals:**

* Integrate external AI API in PHP using cURL
* Parse and structure AI responses
* Store and retrieve data from MySQL
* Create professional UI using Bootstrap
* Implement secure Demo Mode to avoid exposing API keys

---

## 🧠 Quick Summary of Technologies

| Technology     | Purpose                                                              |
| -------------- | -------------------------------------------------------------------- |
| **PHP**        | Server-side scripting, handles forms, API calls, database operations |
| **MySQL**      | Stores generated notes securely                                      |
| **OpenAI API** | Generates AI-powered study notes                                     |
| **cURL**       | Sends HTTP requests to OpenAI API                                    |
| **Dompdf**     | Converts HTML notes to PDF                                           |
| **Bootstrap**  | Responsive, professional UI styling                                  |

---

## ⚙️ System Requirements

* **OS:** Windows / Linux / Mac
* **PHP:** 8+
* **MySQL / MariaDB**
* **Web Server:** XAMPP / Apache or similar
* **Browser:** Any modern browser
* **Optional:** Composer (for Dompdf library)

---

## 🛠 Installation & Setup

1. **Clone / Copy Project**
   Place the project folder in your web server root (e.g., `C:\xampp\htdocs\ai-study-generator`)

2. **Import Database**

```sql
CREATE DATABASE ai_study;
USE ai_study;

CREATE TABLE study_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic VARCHAR(255),
    summary TEXT,
    questions TEXT,
    key_points TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. **Configure `config.php`**

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ai_study";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("DB connection failed: ".$conn->connect_error);

// Demo / Live Mode
$DEMO_MODE = true;            
$OPENAI_API_KEY = "YOUR_API_KEY"; 
?>
```

4. **Install Dompdf (for PDF export)**

```bash
composer require dompdf/dompdf
```

5. **Start Server**
   Ensure **Apache** and **MySQL** are running in XAMPP.
   Open in browser:

```
http://localhost/ai-study-generator/index.php
```

---

## 💻 Minimal Working Example

1. Open `index.php`
2. Enter a topic (e.g., "Magnetism")
3. Click **Generate Notes**
4. Notes appear (Summary, Questions, Key Points)
5. Notes are automatically saved to the database
6. View saved notes on `history.php`
7. Options available: **Delete** note, **Download PDF**, **Live/Demo Mode toggle**

<img width="653" height="296" alt="image" src="https://github.com/user-attachments/assets/ed4dffc8-1dc4-4e16-8241-4b751d4b9177" />
<img width="675" height="513" alt="image" src="https://github.com/user-attachments/assets/f2ccd105-b6d5-420c-9fea-1e961a871d91" />
<img width="543" height="505" alt="image" src="https://github.com/user-attachments/assets/217af43d-e060-4f64-8888-950fa84d5acc" />


---

## 🧠 AI Prompt Journal

| Attempt | Prompt                                                                                                                | Response / Reflection                                                                    |
| ------- | --------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| 1       | `Generate structured study notes for topic: {topic}. Return: 1. Summary, 2. 5 exam-style questions, 3. 3 key points.` | Demo Mode used for safe testing. Output was consistent, structured, easy to parse.       |
| 2       | `Return notes in bullet points for summary, numbered list for questions, bullet points for key points.`               | Improved readability for PDF export and database storage. Useful for structured display. |

---

## ⚠️ Common Issues & Fixes

| Issue                      | Fix                                                             |
| -------------------------- | --------------------------------------------------------------- |
| Dompdf not found           | Install via Composer or download manually into `dompdf/` folder |
| cURL not enabled           | Enable `php_curl` in `php.ini`                                  |
| Database connection failed | Verify credentials in `config.php` and ensure MySQL is running  |
| PDF output empty           | Check HTML validity, ensure Dompdf path correct                 |
| Live Mode not working      | Make sure `$OPENAI_API_KEY` is valid and `$DEMO_MODE = false`   |

---

## 📦 Project Structure

```
ai-study-generator/
├── index.php          # Homepage & topic form
├── generate.php       # AI generation + DB save
├── history.php        # View, delete, export PDF
├── export_pdf.php     # PDF export
├── config.php         # DB + API config + Demo/Live mode
├── database.sql       # Database setup
├── vendor/            # Dompdf library (if Composer used)
├── style.css          # Optional styling
└── README.md          # This file
```

---

## 🔧 Features

* **Demo Mode**: Mock AI responses to safely demo project
* **Live Mode**: Real API integration via OpenAI
* **Delete Notes**: Remove unwanted notes
* **PDF Export**: Download structured notes
* **Responsive UI**: Bootstrap styling for modern look
* **Structured AI Output**: Summary, Questions, Key Points

---

## 📖 References

* [OpenAI API Docs](https://platform.openai.com/docs)
* [PHP Manual](https://www.php.net/manual/en/)
* [MySQL Documentation](https://dev.mysql.com/doc/)
* [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
* [Dompdf GitHub](https://github.com/dompdf/dompdf)


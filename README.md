# SPF Simple PHP Framework
A lightweight, easy-to-use PHP micro-framework for quick prototyping and small applications.  
It provides routing, a tiny template engine, database helpers, and a simple configuration system.

---

## ✨ Features

- **Single Config File** – All settings live in `app.json`.
- **Routing** – Map `?page=slug` to PHP pages.
- **Template Placeholders** – Include CSS/JS/images or config values with `{{ ... }}`.
- **Database Helpers** – Fetch, count and insert data easily.
- **Debug Toggle** – Enable/disable PHP error display from config.
- **Helpers** – Prebuilt functions for common tasks.

---

## 📁 Structure
```
core/
    ├─ functions.php # Helper functions & template engine
    ├─ database.php # Database connection & utilities
pages/
    └─ login.php # Sample page
index.php # Framework entry point (router)
app.json # Configuration file
assets/ # Your CSS, JS, and images
```
---
## ⚙️ Configuration

All settings are defined in `app.json`:

```json
{
  "general": {
    "site_name": "Demo",
    "version": "V1.0",
    "author": "Adnan",
    "debug": true,
    "base_url": "http://localhost/aiub_portal/"
  },
  "routes": {
    "index": "./pages/login.php",
    "test": "./pages/test.php"
  },
  "error_pages": {
    "404": "./pages/error/404.php",
    "403": "",
    "400": ""
  },
  "database": {
    "host": "",
    "username": "",
    "password": "",
    "name": ""
  }
}
```
## Sections:
- general – Site info and debug toggle.
- routes – Map ?page=slug to PHP pages.
- error_pages – Custom error templates.
- database – MySQL credentials.
---  
## 🚀 Getting Started
1. Clone the repository:
`git clone https://github.com/YOURUSERNAME/YOURFRAMEWORK.git`
1. Update **app.json** with your site info, routes, error pages and DB credentials.
2. Add your own pages inside **pages/** and reference them in routes.
3. Run on a local server *(XAMPP, WAMP, etc.)* and open:
`http://localhost/aiub_portal/ -- Example`

---

## 🎨 Template Placeholders
Inside any page you can use placeholders:

`<title>{{general->site_name}} Login</title>`

`{{style=default.css}}`

`{{js=main.js}}`

`{{img=logo.png}}`


`{{general->site_name}}` outputs the config value.

`{{style=default.css}}` loads `<link rel="stylesheet" ...>`.

`{{js=main.js}}` loads `<script ...>`.

`{{img=logo.png}}` loads `<img src=...>`. 

---

## 🛠️ Helper Functions

| Function                           | Description                                        | Example                                        |
| ---------------------------------- | -------------------------------------------------- | ---------------------------------------------- |
| `esc($str)`                        | Escape HTML special chars.                         | `echo esc($input);`                            |
| `reqPost($field)`                  | Get escaped `$_POST` value.                        | `$username = reqPost('username');`             |
| `reqGet($field)`                   | Get escaped `$_GET` value.                         | `$page = reqGet('page');`                      |
| `sendCurl($data,$esc=0)`           | Send cURL request with options array.              | `sendCurl([CURLOPT_URL=>'https://api...'],1);` |
| `sendReq($url,$esc=0)`             | Fetch URL contents.                                | `$html = sendReq('http://example.com');`       |
| `write($filename,$data,$mode="a")` | Write to file. Returns 1 on success.               | `write('log.txt','hello');`                    |
| `prettyPrint($data)`               | Debug print arrays/objects.                        | `prettyPrint($_POST);`                         |
| `setJsonValue($buffer)`            | Template parser (used automatically by index.php). | (see placeholders above)                       |

---
## 🗄️ Database Helpers
| Function                                       | Description                              | Example                                                                  |
| ---------------------------------------------- | ---------------------------------------- | ------------------------------------------------------------------------ |
| `FetchData($select,$table,$extra='',$id=0)`    | Select fields from a table.              | `$name = FetchData('name','users','id=1');`                              |
| `GetCount($table,$select='',$id='',$extra='')` | Count rows.                              | `$total = GetCount('users');`                                            |
| `InsertTable($table,$array)`                   | Insert a new row with associative array. | `InsertTable('users',['username'=>'john','email'=>'john@example.com']);` |

---
## 🧑‍💻 Example Page
`pages/login.php` demonstrates:
```html
<!DOCTYPE html>
<html>
<head>
  <title>{{general->site_name}} Login</title>
  {{style=default.css}}
</head>
<body>
  <img src="{{img=aiub_logo.svg}}">
  <!-- Login form here -->
</body>
</html>
```

---

## 🤝 Contributing
Contributions are welcome. Fork the repo, create a branch, and submit a pull request.

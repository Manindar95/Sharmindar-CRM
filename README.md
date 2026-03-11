<p align="center">
  <img src="assets/Sharmindar-CRM_logo-name.png" alt="Sharmindar CRM" width="400">
</p>

# Sharmindar CRM

**A CRM solution for IT and SaaS companies, built through Vibe Coding using the open-source [Sharmindar CRM](https://krayincrm.com) framework.**

Sharmindar CRM is a customized Customer Relationship Management system designed to streamline customer lifecycle management for IT and SaaS businesses. It is built on top of powerful open-source technologies including [Laravel](https://laravel.com) and [Vue.js](https://vuejs.org).

---

## ✨ Features

- 📊 **Admin Dashboard** — Clean, descriptive admin panel for managing your CRM data
- 👥 **Lead & Contact Management** — Track and manage leads, contacts, and organizations
- 💼 **Pipeline Management** — Visual sales pipeline to track deals and opportunities
- 📋 **Activity Management** — Schedule calls, meetings, and tasks
- ⏱️ **Timesheet Tracking** — Track time spent on projects and tasks
- 📧 **Email Integration** — Email parsing and communication tracking
- 🔧 **Custom Attributes** — Extend entities with custom fields
- 🧱 **Modular Architecture** — Built on a modular approach for easy customization

---

## 🛠️ Tech Stack

| Technology | Purpose           |
|------------|-------------------|
| Laravel    | Backend Framework |
| Vue.js     | Frontend Framework|
| MySQL      | Database          |
| PHP 8.1+   | Server Language   |

---

## 📋 Requirements

- **Server**: Apache 2 or NGINX
- **RAM**: 3 GB or higher
- **PHP**: 8.1 or higher
- **MySQL**: 5.7.23 or higher (or MariaDB 10.2.7+)
- **Node.js**: 8.11.3 LTS or higher
- **Composer**: 2.5 or higher

---

## 🚀 Installation

1. Clone the repository:

```bash
git clone https://github.com/Manindar95/Sharmindar-CRM.git
```

2. Install dependencies:

```bash
composer install
```

3. Configure the `.env` file — set your `APP_URL`, database, and mail settings.

4. Run the installer:

```bash
php artisan sharmindar-crm:install
```

5. Start the local development server:

```bash
php artisan serve
```

---

## 🔐 Admin Login

> URL: `http://your-domain.com/admin/login`

```
Email:    admin@example.com
Password: admin123
```

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙏 Acknowledgements

Sharmindar CRM is inspired by and built upon the open-source [Sharmindar CRM](https://krayincrm.com) framework by the Sharmindar CRM Contributors. Full credit to the Sharmindar team for the foundational CRM framework.

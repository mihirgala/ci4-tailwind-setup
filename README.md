# ci4-tailwind-setup

> A production-ready boilerplate combining **CodeIgniter 4** with **Tailwind CSS 4**. Modular view architecture, GSAP-ready animations, and a streamlined dev workflow.

```bash
# Quick start
git clone https://github.com/mihirgala/ci4-tailwind-setup.git
cd ci4-tailwind-setup
composer install && npm install
cp .env.example .env
```

---

## Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | PHP 8.2+ / CodeIgniter 4.x |
| **Frontend** | Tailwind CSS 4 |
| **Animations** | GSAP (GreenSock) |
| **Build** | Tailwind CLI via npm |

---

## Development

Open **two terminals**:

```bash
# Terminal 1 — Watch Tailwind for changes
npm run dev

# Terminal 2 — Start PHP dev server
php spark serve
# → http://localhost:8080
```

### Production build

```bash
npm run build
```

---

## Project Structure

```
.
├── app/
│   ├── Controllers/        # Application logic
│   ├── Views/
│   │   ├── layouts/        # Base layout (main.php)
│   │   ├── pages/          # Page templates
│   │   ├── partials/       # Reusable partials (navbar, footer)
│   │   └── sections/       # Reusable sections (hero, etc.)
│   └── ...
├── assets/
│   └── css/input.css       # Tailwind entry point
├── public/
│   ├── css/output.css      # Compiled CSS (auto-generated)
│   └── js/                 # Client-side JS / GSAP
├── package.json
└── composer.json
```

---

## Features

- **CodeIgniter 4.x** — Light, fast, secure PHP framework with DB abstraction, validation, caching
- **Tailwind CSS 4** — CSS-first config, JIT engine, fully responsive
- **GSAP Ready** — Scroll-triggered animations and interactive components
- **Modular Views** — Layouts, pages, partials, and sections powered by config arrays
- **Dev Workflow** — Single `npm run dev` command watches and recompiles Tailwind

---

## Security

Document root must point to `public/`. The `index.php` front controller lives there to prevent direct access to system files, following CI4 best practices.

---

## License

ISC — see [LICENSE](LICENSE).

# Git & GitHub Setup for Collaboration

Your project is now under Git with an initial commit on the `main` branch. Follow these steps to use GitHub and collaborate with others.

---

## 1. Configure your Git identity (if not done)

So your commits show the right name and email:

```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

---

## 2. Create a repository on GitHub

1. Go to [github.com](https://github.com) and sign in.
2. Click **New repository** (or the **+** menu → **New repository**).
3. Choose a name (e.g. `myproject`), add a description if you like.
4. **Do not** initialize with a README, .gitignore, or license (you already have them).
5. Click **Create repository**.

---

## 3. Connect your local project to GitHub

After creating the repo, GitHub shows commands. Use these (replace `YOUR_USERNAME` and `YOUR_REPO` with your values):

```bash
cd c:\xampp\htdocs\dashboard\myproject

git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

If your repo URL is SSH:

```bash
git remote add origin git@github.com:YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

You may be asked to sign in (HTTPS) or use SSH keys (SSH).

---

## 4. Invite collaborators

1. Open your repo on GitHub.
2. Go to **Settings** → **Collaborators** (or **Collaborators and teams**).
3. Click **Add people** and enter their GitHub username or email.
4. They accept the invite from their email or GitHub notifications.

---

## 5. Workflow for you and collaborators

### You (owner) – daily workflow

```bash
# See what changed
git status

# Stage changes
git add .
# Or specific files: git add path/to/file.php

# Commit with a message
git commit -m "Short description of what you did"

# Push to GitHub
git push
```

### Collaborators – first time

```bash
# Clone the repo (they use the repo URL from GitHub)
git clone https://github.com/YOUR_USERNAME/YOUR_REPO.git
cd YOUR_REPO

# Install Laravel dependencies
composer install
cp .env.example .env
php artisan key:generate
# Configure .env (DB, etc.) then:
php artisan migrate
```

### Collaborators – daily workflow

```bash
# Get latest changes before working
git pull

# After making changes: add, commit, push
git add .
git commit -m "Description of changes"
git push
```

---

## 6. Using branches (recommended for collaboration)

Avoid pushing directly to `main` for big or risky changes. Use a branch and then merge or open a Pull Request.

```bash
# Create and switch to a new branch
git checkout -b feature/my-feature-name

# Work, then commit
git add .
git commit -m "Add my feature"

# Push the branch to GitHub
git push -u origin feature/my-feature-name
```

On GitHub: open a **Pull Request** from `feature/my-feature-name` into `main`, review, then merge.

After merging (or if someone else merged):

```bash
git checkout main
git pull
```

---

## 7. Useful commands

| Command | Purpose |
|--------|--------|
| `git status` | See modified/untracked files |
| `git pull` | Get latest changes from GitHub |
| `git log --oneline` | View recent commits |
| `git branch -a` | List branches |
| `git diff` | See unstaged changes |

---

## 8. Important: never commit secrets

- `.env` is already in `.gitignore` (never commit it).
- New collaborators copy `.env.example` to `.env` and fill in their own values.
- Do not put API keys, passwords, or secrets in code or in committed files.

---

## Quick reference after setup

- **Your repo URL:** `https://github.com/YOUR_USERNAME/YOUR_REPO`
- **Default branch:** `main`
- **First push:** `git remote add origin <URL>` then `git push -u origin main`
- **Later pushes:** `git push`

If you hit authentication issues (HTTPS), use a [Personal Access Token](https://github.com/settings/tokens) instead of a password, or set up [SSH keys](https://docs.github.com/en/authentication/connecting-to-github-with-ssh).

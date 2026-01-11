# Mimi Vibe Template

Golden template for Bifrost Vibe sessions. This is a pre-configured Laravel + NativePHP Mobile project used as the starting point for all Mimi AI coding sessions.

## How It's Used

This repository is configured as a **GitHub Template Repository**. When Bifrost provisions a new Vibe session, it uses the GitHub API to create a new repository from this template:

```
POST /repos/Bifrost-Mimi/vibe-template/generate
```

This creates an instant copy with a clean git history - no cloning or pushing required.

## What's Included

- **Laravel** - Latest version with standard configuration
- **NativePHP Mobile** - Pre-installed and configured
- **Laravel Boost** - MCP server for Claude Code integration
- **Claude Code Configuration** - `.claude/settings.json` with security sandbox settings
- **CLAUDE.md** - Generated guidelines for the AI assistant
- **Frontend Assets** - Pre-built with Vite

## Updating the Template

Changes to this repository will be picked up by all **new** Vibe sessions. Existing sessions are not affected.

```bash
# Make your changes
git add .
git commit -m "Description of changes"
git push
```

## Automated Updates

This repository has a GitHub Action that runs daily to keep dependencies up to date:

- Runs `composer update` and commits `composer.lock`
- Runs `npm update` and commits `package-lock.json`
- Runs `npm run build` to verify the build still works (assets are gitignored)

## Local Development

If you need to test changes locally:

```bash
git clone git@github.com:Bifrost-Mimi/vibe-template.git
cd vibe-template
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## Related

- [Bifrost](https://github.com/nativephp/bifrost) - The main Bifrost application
- [NativePHP](https://nativephp.com) - Build native mobile & desktop apps with PHP
